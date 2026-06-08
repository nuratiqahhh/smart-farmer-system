<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;

class FarmerController extends Controller
{
    public function dashboard()
    {
        $farmerId = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        $productCount = Product::where('user_id', $farmerId)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | FARMER PRODUCTS IDS
        |--------------------------------------------------------------------------
        */

        $productIds = Product::where('user_id', $farmerId)
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */

        $orderCount = Order::whereIn('product_id', $productIds)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | REVENUE
        |--------------------------------------------------------------------------
        */

        $revenue = Order::whereIn('product_id', $productIds)
            ->sum('total_price');

        /*
        |--------------------------------------------------------------------------
        | LOW STOCK
        |--------------------------------------------------------------------------
        */

        $lowStockCount = Product::where('user_id', $farmerId)
            ->where('quantity', '<', 5)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | AVERAGE ORDER
        |--------------------------------------------------------------------------
        */

        $averageOrder = $orderCount > 0
            ? $revenue / $orderCount
            : 0;

        return view('farmer.dashboard', compact(
            'productCount',
            'orderCount',
            'revenue',
            'lowStockCount',
            'averageOrder'
        ));
    }
}