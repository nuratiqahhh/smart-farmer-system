<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * CHECKOUT PAGE
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        // calculate total
        $total = 0;

        foreach ($carts as $cart) {

            $total += $cart->product->price * $cart->quantity;

        }

        return view('checkout.index', compact('carts', 'total'));
    }

    /**
     * STORE ORDER / PAYMENT PROCESS
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([

            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required',

        ]);

        // get cart items
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        // save orders
        foreach ($carts as $cart) {

            // find product
            $product = Product::find($cart->product_id);

            // PREVENT NEGATIVE STOCK 🔥
            if ($product && $product->quantity >= $cart->quantity) {

                // reduce stock
                $product->quantity =
                    $product->quantity - $cart->quantity;

                $product->save();

                // SAVE ORDER
                Order::create([

                    'buyer_id' => auth()->id(),

                    'product_id' => $cart->product_id,

                    'quantity' => $cart->quantity,

                    'total_price' =>
                        $cart->product->price * $cart->quantity,

                ]);
            }

        }

        // clear cart
        Cart::where('user_id', auth()->id())->delete();

        // redirect success page
        return redirect('/payment-success');
    }
}