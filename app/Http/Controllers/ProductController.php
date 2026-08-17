<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display all farmer products
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;
        $grade = $request->grade;
        $stock = $request->stock;

        $products = Product::where('user_id', auth()->id())

            // SEARCH
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('grade', 'like', '%' . $search . '%');

                });

            })

            // CATEGORY FILTER
            ->when($category, function ($query, $category) {

                $query->where('category', $category);

            })

            // GRADE FILTER
            ->when($grade, function ($query, $grade) {

                $query->where('grade', $grade);

            })

            // STOCK FILTER
            ->when($stock === 'low', function ($query) {

                $query->where('quantity', '<=', 5);

            })

            ->when($stock === 'available', function ($query) {

                $query->where('quantity', '>', 5);

            })

            ->latest()
            ->paginate(5);

        return view('products.index', compact(
            'products',
            'search',
            'category',
            'grade',
            'stock'
        ));
    }

    /**
     * Show add product form
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store product
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'category' => 'required',
            'grade' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,jfif|max:2048',

        ]);

        // upload image
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('products'), $imageName);

        // save product
        Product::create([

            'name' => $request->name,
            'category' => $request->category,
            'grade' => $request->grade,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'image' => $imageName,
            'user_id' => auth()->id(),

        ]);

        return redirect()->route('farmer-products.index')
            ->with('success', 'Product added successfully!');
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('farmer-products.index')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Edit product
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',
            'category' => 'required',
            'grade' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',

        ]);

        $product = Product::findOrFail($id);

        // update image if new image uploaded
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('products'), $imageName);

            $product->image = $imageName;
        }

        // update product
        $product->update([

            'name' => $request->name,
            'category' => $request->category,
            'grade' => $request->grade,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,

        ]);

        return redirect()->route('farmer-products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Admin view products
     */
    public function adminIndex(Request $request)
    {
        $search = $request->search;

        $products = Product::query()
            ->when($search, function ($query, $search) {

                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('grade', 'like', '%' . $search . '%');

            })
            ->latest()
            ->paginate(5);

        return view('admin.products', compact(
            'products',
            'search'
        ));
    }

    /**
     * Buyer Shop Page
     */
    public function shop(Request $request)
    {
        $search = $request->search;

        /*
        |--------------------------------------------------------------------------
        | FIFO PRODUCT DISPLAY
        |--------------------------------------------------------------------------
        */

        $products = Product::query()

            ->when($search, function ($query, $search) {

                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%')
                      ->orWhere('grade', 'like', '%' . $search . '%');

            })

            ->orderBy('created_at', 'asc')

            ->get();

            $cartCount = 0;

if (auth()->check()) {

    $cartCount = \App\Models\Cart::where('user_id', auth()->id())
    ->count();
}

        return view('shop.index', compact('products', 'cartCount'));
    }

    /**
     * Display product details
     */
    public function show(Product $product)
    {
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $cartCount = 0;

        if (auth()->check()) {
            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
        }

        return view('shop.show', compact(
            'product',
            'relatedProducts',
            'cartCount'
        ));
    }
}