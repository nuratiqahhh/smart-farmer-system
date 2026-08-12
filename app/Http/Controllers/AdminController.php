<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Dashboard Cards
        $productCount = Product::count();
        $orderCount = Order::count();
        $userCount = User::count();
        $totalRevenue = Order::sum('total_price');

        // Today's Analytics
        $todaySales = Order::whereDate('created_at', Carbon::today())
            ->sum('total_price');

        $todayOrders = Order::whereDate('created_at', Carbon::today())
            ->count();

        // Top Customer
        $topCustomer = User::select('users.name')
            ->join('orders', 'users.id', '=', 'orders.buyer_id')
            ->selectRaw('users.name, COUNT(orders.id) as total_orders')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_orders')
            ->first();

        $lowStockProducts = Product::where('quantity', '<=', 5)
            ->take(3)
            ->get();

        $topProducts = Order::selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $deliveryCount = Order::where('delivery_method', 'delivery')->count();

        $pickupCount = Order::where('delivery_method', 'pickup')->count();

        $latestOrders = Order::latest()
            ->take(5)
            ->get();

        $recentActivities = Order::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'productCount',
            'orderCount',
            'userCount',
            'totalRevenue',
            'todaySales',
            'todayOrders',
            'topCustomer',
            'lowStockProducts',
            'topProducts',
            'deliveryCount',
            'pickupCount',
            'latestOrders',
            'recentActivities'
        ));
    }
}