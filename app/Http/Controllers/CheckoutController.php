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

            'fullname' => 'required|min:3|max:100',

            'phone' => [
                'required',
                'regex:/^[0-9]{10,11}$/'
            ],

            'address' => 'required|min:10|max:255',

            'payment_method' => 'required',

            'delivery_method' => 'required',

        ], [

            'fullname.required' => 'Full name is required.',
            'fullname.min' => 'Full name must be at least 3 characters.',

            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number must contain 10 or 11 digits.',

            'address.required' => 'Address is required.',
            'address.min' => 'Address must be at least 10 characters.',

            'payment_method.required' => 'Please select a payment method.',

            'delivery_method.required' => 'Please select a delivery method.',

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

                    'status' => 'Paid',

                    'delivery_method' => $request->delivery_method,

                    'fullname' => $request->fullname,

                    'phone' => $request->phone,

                    'address' => $request->address,

                    'payment_method' => $request->payment_method,

                ]);

            }

        }

        // clear cart
        Cart::where('user_id', auth()->id())->delete();

        // redirect success page
        return redirect('/payment-success');
    }
}