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

    public function adminOrders(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $delivery = $request->delivery;

        $orders = Order::with(['product', 'buyer'])

            // Search customer / product
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where('fullname', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhereHas('product', function ($productQuery) use ($search) {

                        $productQuery->where('name', 'like', '%' . $search . '%');

                    });

                });

            })

            // Filter status
            ->when($status, function ($query, $status) {

                $query->where('status', $status);

            })

            // Filter delivery
            ->when($delivery, function ($query, $delivery) {

                $query->where('delivery_method', $delivery);

            })

            ->latest()
            ->paginate(5);

        return view('admin.orders', compact(
            'orders',
            'search',
            'status',
            'delivery'
        ));
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

        if ($order->status == 'Paid') {

            $order->status = 'Preparing';

        } elseif ($order->status == 'Preparing') {

            if ($order->delivery_method == 'pickup') {

                $order->status = 'Ready for Pickup';

            } else {

                $order->status = 'Out for Delivery';

            }

        } elseif (
            $order->status == 'Ready for Pickup' ||
            $order->status == 'Out for Delivery'
        ) {

            $order->status = 'Completed';

        }

        $order->save();

        return back()->with('success', 'Order status updated!');
    }
}