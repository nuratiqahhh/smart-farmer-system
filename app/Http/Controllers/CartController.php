<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // 🔥 ADD TO CART
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $id)
                    ->first();

        if ($cart) {

            $cart->quantity += $request->quantity;
            $cart->save();

        } else {

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart!');
    }

    // 🔥 VIEW CART
    public function index()
    {
        $carts = Cart::with('product')
                    ->where('user_id', auth()->id())
                    ->get();

        return view('cart.index', compact('carts'));
    }

    // 🔥 REMOVE ITEM
    public function remove($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Item removed!');
    }
}