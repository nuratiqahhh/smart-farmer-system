<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * VIEW CUSTOMER ORDERS (Farmer/Admin)
     */
    public function index()
    {
        $orders = Order::with(['product', 'buyer'])
            ->whereHas('product', function ($query) {

                $query->where('user_id', auth()->id());

            })
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function adminOrders()
    {
        $orders = Order::with(['product', 'buyer'])
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * BUYER ORDER HISTORY
     */
    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('buyer_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }

    /**
     * CREATE ORDER FORM
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * STORE MANUAL ORDER
     */
    public function store(Request $request)
    {
        Order::create($request->all());

        return redirect()->route('orders.index');
    }

    /**
     * BUY PRODUCT
     */
    public function buy($id)
    {
        $product = Product::findOrFail($id);

        // default quantity
        $quantity = 1;

        // calculate total
        $total = $product->price * $quantity;

        // save order
        Order::create([

            'buyer_id' => auth()->id(),

            'product_id' => $product->id,

            'quantity' => $quantity,

            'total_price' => $total,

            'status' => 'Paid',

        ]);

        // reduce stock
        $product->quantity -= 1;

        $product->save();

        return redirect()
            ->back()
            ->with('success', 'Order placed successfully!');
    }

    /**
     * COMPLETE ORDER
     */
    public function complete($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'Completed';

        $order->save();

        return redirect()
            ->back()
            ->with('success', 'Order marked as completed!');
    }
}