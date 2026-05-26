<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmer Dashboard</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-800 text-white p-6 shadow-xl">

        <h2 class="text-3xl font-bold mb-10">
            🌾 Farmer Panel
        </h2>

        <ul class="space-y-3">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block bg-green-700 px-4 py-3 rounded-xl font-medium">
                    Dashboard
                </a>
            </li>

            <!-- Products -->
            <li>
                <a href="{{ route('products.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-xl transition">
                    My Products
                </a>
            </li>

            <!-- Orders -->
            <li>
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-xl transition">
                    Customer Orders
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ url('/farmer/profile') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-xl transition">
                    Profile
                </a>
            </li>

            <!-- Logout -->
            <li class="pt-10">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left hover:bg-red-600 px-4 py-3 rounded-xl transition">
                        Logout
                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-4xl font-bold text-gray-800">
                    Farmer Dashboard
                </h1>

                <p class="text-gray-500 mt-2">
                    Welcome back, manage your farm business here.
                </p>

            </div>

            <div class="bg-white px-5 py-3 rounded-xl shadow">

                <span class="text-gray-600">
                    Welcome, {{ auth()->user()->name }}
                    ({{ auth()->user()->role }})
                </span>

            </div>

        </div>

        <!-- ANALYTICS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            <!-- PRODUCTS -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">

                <h3 class="text-gray-500 text-sm">
                    My Products
                </h3>

                <p class="text-3xl font-bold text-green-700 mt-3">

                    {{ \App\Models\Product::where('user_id', auth()->id())->count() }}

                </p>

            </div>

            <!-- ORDERS -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">

                <h3 class="text-gray-500 text-sm">
                    Customer Orders
                </h3>

                <p class="text-3xl font-bold text-blue-600 mt-3">

                    {{ \App\Models\Order::count() }}

                </p>

            </div>

            <!-- REVENUE -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">

                <h3 class="text-gray-500 text-sm">
                    Revenue
                </h3>

                <p class="text-3xl font-bold text-purple-600 mt-3">

                    RM
                    {{ number_format(\App\Models\Order::sum('total_price'), 2) }}

                </p>

            </div>

            <!-- LOW STOCK -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">

                <h3 class="text-gray-500 text-sm">
                    Low Stock Products
                </h3>

                <p class="text-3xl font-bold text-red-500 mt-3">

                    {{
                        \App\Models\Product::where('quantity', '<=', 5)->count()
                    }}

                </p>

            </div>

            <!-- AVERAGE ORDER -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">

                <h3 class="text-gray-500 text-sm">
                    Average Order
                </h3>

                <p class="text-3xl font-bold text-orange-500 mt-3">

                    RM
                    {{
                        number_format(
                            \App\Models\Order::avg('total_price') ?? 0,
                            2
                        )
                    }}

                </p>

            </div>

        </div>

        <!-- OVERVIEW -->
        <div class="mt-8 bg-white p-6 rounded-2xl shadow-lg">

            <h2 class="text-2xl font-bold mb-4">
                Farmer Overview
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Manage your products, monitor customer purchases,
                track low stock inventory, and analyse your sales
                performance in one dashboard.
            </p>

        </div>

        <!-- SALES ANALYTICS -->
        <div class="mt-10 bg-white p-6 rounded-2xl shadow-lg">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        📊 Weekly Sales Analytics
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        Monitor your weekly sales performance.
                    </p>

                </div>

                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                    Sales Report
                </span>

            </div>

            <!-- CHART -->
            <div class="h-96">

                <canvas id="salesChart"></canvas>

            </div>

        </div>

        <!-- TOP SELLING PRODUCT -->
        <div class="mt-10 bg-white p-6 rounded-2xl shadow-lg">

            <h2 class="text-2xl font-bold mb-6">
                🏆 Top Selling Product
            </h2>

            @php

                $topProduct = \App\Models\Order::select(
                        'product_id',
                        \DB::raw('SUM(quantity) as total_sold')
                    )
                    ->groupBy('product_id')
                    ->orderByDesc('total_sold')
                    ->first();

            @endphp

            @if($topProduct)

                @php
                    $product =
                        \App\Models\Product::find($topProduct->product_id);
                @endphp

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="text-3xl font-bold text-green-700">

                            {{ $product->name ?? 'Unknown Product' }}

                        </h3>

                        <p class="text-gray-500 mt-2">
                            Best selling product in your store
                        </p>

                    </div>

                    <span class="bg-green-100 text-green-700 px-5 py-2 rounded-full">
                        {{ $topProduct->total_sold }} sold
                    </span>

                </div>

            @else

                <p class="text-gray-500">
                    No sales data available.
                </p>

            @endif

        </div>

        <!-- LOW STOCK ALERT -->
        <div class="mt-10 bg-white p-6 rounded-2xl shadow-lg">

            <h2 class="text-2xl font-bold text-red-500 mb-6">
                ⚠ Low Stock Alert
            </h2>

            @php

                $lowStocks =
                    \App\Models\Product::where('quantity', '<=', 5)->get();

            @endphp

            @if($lowStocks->count() > 0)

                <div class="space-y-4">

                    @foreach($lowStocks as $product)

                        <div class="flex justify-between items-center bg-red-50 border border-red-200 p-4 rounded-xl">

                            <div>

                                <h3 class="font-bold text-lg text-red-600">

                                    {{ $product->name }}

                                </h3>

                                <p class="text-gray-500">
                                    Remaining Stock:
                                    {{ $product->quantity }}
                                </p>

                            </div>

                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm">
                                Low Stock
                            </span>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="text-center py-12">

                    <div class="text-6xl mb-4">
                        ✅
                    </div>

                    <h3 class="text-3xl font-bold text-gray-700 mb-2">
                        No Low Stock Products
                    </h3>

                    <p class="text-gray-500">
                        All your inventory levels are healthy.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Mon',
                'Tue',
                'Wed',
                'Thu',
                'Fri',
                'Sat',
                'Sun'
            ],

            datasets: [{

                label: 'Sales',

                data: [12, 19, 8, 15, 10, 20, 18],

                backgroundColor: [
                    '#16a34a',
                    '#22c55e',
                    '#4ade80',
                    '#86efac',
                    '#0f766e',
                    '#14b8a6',
                    '#3b82f6'
                ],

                borderRadius: 12,

                borderSkipped: false

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: true,

                    position: 'top'

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        stepSize: 5

                    },

                    grid: {

                        color: '#e5e7eb'

                    }

                },

                x: {

                    grid: {

                        display: false

                    }

                }

            }

        }

    });

</script>

</body>
</html>