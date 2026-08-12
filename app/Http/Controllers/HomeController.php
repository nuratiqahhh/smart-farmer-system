<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalFarmers = User::where('role', 'farmer')->count();

        $totalOrders = Order::count();

        $totalRevenue = Order::sum('total_price');

        $farmers = User::where('role', 'farmer')
            ->withCount('products')
            ->latest()
            ->get();

        $featuredProducts = Product::latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'totalProducts',
            'totalFarmers',
            'totalOrders',
            'totalRevenue',
            'featuredProducts',
            'farmers'
        ));
    }
}