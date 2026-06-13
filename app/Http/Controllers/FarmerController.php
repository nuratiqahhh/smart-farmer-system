<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

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

        $lowStockProducts = Product::where('user_id', $farmerId)
            ->where('quantity', '<', 5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | AVERAGE ORDER
        |--------------------------------------------------------------------------
        */

        $averageOrder = $orderCount > 0
            ? $revenue / $orderCount
            : 0;


        /*
        |--------------------------------------------------------------------------
        | TOP SELLING PRODUCT
        |--------------------------------------------------------------------------
        */

        $topSelling = Order::selectRaw('product_id, SUM(quantity) as total_sold')
            ->whereIn('product_id', $productIds)
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first();

        $topProductName = 'No Sales Yet';
        $topProductSold = 0;

        if ($topSelling) {

            $product = Product::find($topSelling->product_id);

            if ($product) {

                $topProductName = $product->name;
                $topProductSold = $topSelling->total_sold;
            }
        }

        $salesData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i);

            $salesData[] = Order::whereIn('product_id', $productIds)
                ->whereDate('created_at', $date)
                ->sum('total_price');
        }


        return view('farmer.dashboard', compact(
            'productCount',
            'orderCount',
            'revenue',
            'lowStockCount',
            'lowStockProducts',
            'averageOrder',
            'topProductName',
            'topProductSold',
            'salesData'
        ));
    }
}