<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display all farmer products
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->get();

        return view('products.index', compact('products'));
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
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'image' => $imageName,
            'user_id' => auth()->id(),

        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')
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
        $product = Product::findOrFail($id);

        $product->update([

            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,

        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Admin view products
     */
    public function adminIndex()
    {
        $products = Product::all();

        return view('admin.products', compact('products'));
    }

    /**
     * Buyer Shop Page
     */
    public function shop(Request $request)
    {
        $search = $request->search;

        $products = Product::query()

            ->when($search, function ($query, $search) {

                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('category', 'like', '%' . $search . '%');

            })

            ->latest()

            ->get();

        return view('shop.index', compact('products'));
    }
}