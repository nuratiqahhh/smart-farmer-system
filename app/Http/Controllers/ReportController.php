<?php

namespace App\Http\Controllers;

use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')
            ->latest()
            ->get();

        $totalRevenue = $orders->sum('total_price');

        $totalOrders = $orders->count();

        $totalQuantity = $orders->sum('quantity');

        $topProduct = Order::with('product')
            ->selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first();

        $topProductName = 'No Sales';

        if ($topProduct && $topProduct->product) {

            $topProductName = $topProduct->product->name;

        }

        return view(
            'reports.index',
            compact(
                'orders',
                'totalRevenue',
                'totalOrders',
                'totalQuantity',
                'topProductName'
            )
        );
    }
}