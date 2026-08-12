<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;

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

        $subtotal = 0;

        foreach ($carts as $cart) {
            $subtotal += $cart->product->price * $cart->quantity;
        }

        $serviceCharge = 1.00;
        $total = $subtotal + $serviceCharge;

        return view(
            'checkout.index',
            compact(
                'carts',
                'subtotal',
                'serviceCharge',
                'total'
            )
        );
    }

    /**
     * STORE ORDER / PAYMENT PROCESS
     */
    public function store(Request $request)
    {
        $request->validate([

            'fullname' => 'required|min:3|max:100',

            'phone' => [
                'required',
                'regex:/^[0-9]{10,11}$/'
            ],

            'address' => 'required_if:delivery_method,delivery|min:10|max:255',

            'payment_method' => 'required',

            'delivery_method' => 'required',

        ], [

            'fullname.required' => 'Full name is required.',
            'fullname.min' => 'Full name must be at least 3 characters.',

            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number must contain 10 or 11 digits.',

            'address.required_if' => 'Address is required for home delivery.',
            'address.min' => 'Address must be at least 10 characters.',

            'payment_method.required' => 'Please select a payment method.',

            'delivery_method.required' => 'Please select a delivery method.',

        ]);

        // Get cart items
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        foreach ($carts as $cart) {

            $product = Product::find($cart->product_id);

            // Product tidak wujud
            if (!$product) {

                return back()->with(
                    'error',
                    'Product not found.'
                );

            }

            // Stock tidak mencukupi
            if ($product->quantity < $cart->quantity) {

                return back()->with(
                    'error',
                    'Insufficient stock for ' . $product->name
                );

            }

            // Tolak stock
            $product->quantity -= $cart->quantity;
            $product->save();

            // Kira jumlah
            $productTotal = $product->price * $cart->quantity;

            $deliveryFee = $request->delivery_method == 'delivery'
                ? 5
                : 0;

            $serviceCharge = 1;

            $finalTotal =
                $productTotal +
                $deliveryFee +
                $serviceCharge;

            // Simpan Order
            $order = Order::create([

                'buyer_id' => auth()->id(),

                'product_id' => $cart->product_id,

                'quantity' => $cart->quantity,

                'total_price' => $finalTotal,

                'status' => 'Paid',

                'delivery_method' => $request->delivery_method,

                'fullname' => $request->fullname,

                'phone' => $request->phone,

                'address' => $request->address,

                'payment_method' => $request->payment_method,

            ]);

            // Simpan Payment
            Payment::create([

                'order_id' => $order->id,

                'amount' => $order->total_price,

                'payment_method' => $request->payment_method,

                'payment_status' => 'Paid',

                'payment_date' => now(),

            ]);

            // Update alamat buyer jika Delivery
            if ($request->delivery_method == 'delivery') {

                auth()->user()->update([

                    'address' => $request->address

                ]);

            }

        }

        // Clear cart
        Cart::where('user_id', auth()->id())->delete();

        // Redirect success
        return redirect('/payment-success');
    }
}