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

        /*
        |--------------------------------------------------------------------------
        | SMART INVENTORY RECOMMENDATION
        |--------------------------------------------------------------------------
        */

        $recommendations = [];

        foreach ($productIds as $productId) {

            $product = Product::find($productId);

            if (!$product) {
                continue;
            }

            $averageSold = Order::where('product_id', $product->id)
                ->avg('quantity');

            $averageSold = round($averageSold);

            if ($averageSold < 1) {
                $averageSold = 1;
            }

            $stock = $product->quantity;

            if ($stock <= ($averageSold * 2)) {

                $priority = 'HIGH';
                $message = 'Harvest immediately to avoid stock shortage.';

            } elseif ($stock <= ($averageSold * 5)) {

                $priority = 'MEDIUM';
                $message = 'Prepare the next harvest soon.';

            } else {

                $priority = 'LOW';
                $message = 'Current stock is sufficient.';

            }

            $recommendations[] = [

                'product' => $product->name,
                'stock' => $stock,
                'average' => $averageSold,
                'suggest' => $averageSold * 5,
                'priority' => $priority,
                'message' => $message,

            ];

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
            'salesData',
            'recommendations'
        ));
    }
}