<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    @vite('resources/css/app.css')

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-green-800 text-white p-6">
        <h2 class="text-2xl font-bold mb-8">🌾 Farmer System</h2>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                class="block hover:bg-green-700 p-3 rounded-xl">

                    Dashboard

                </a>
            </li>

            <li>
                <a href="{{ route('admin.products') }}"
                class="block hover:bg-green-700 p-3 rounded-xl">

                    Products

                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders') }}"
                class="block hover:bg-green-700 p-3 rounded-xl">

                    Orders

                </a>
            </li>

            <li>
                <a href="{{ route('admin.users') }}"
                class="block hover:bg-green-700 p-3 rounded-xl">

                    Users

                </a>
            </li>
            <li class="mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left hover:bg-red-600 p-2 rounded">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main -->
    <div class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
            <span>Welcome, {{ auth()->user()->name }}</span>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-10">

            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h3>Total Products</h3>
                <p class="text-2xl text-green-700 font-bold">
                    {{ \App\Models\Product::count() }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h3>Total Orders</h3>
                <p class="text-2xl text-blue-600 font-bold">
                    {{ \App\Models\Order::count() }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h3>Total Users</h3>
                <p class="text-2xl text-purple-600 font-bold">
                    {{ \App\Models\User::count() }}
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h3>Total Transaction Value (RM)</h3>
                <p class="text-2xl text-red-600 font-bold">
                    {{ \App\Models\Order::sum('total_price') }}
                </p>
            </div>

           <div class="bg-white p-8 rounded-2xl shadow-lg">

                <h3>Low Stock Alert</h3>

                @php

                $lowStockProducts =
                \App\Models\Product::where(
                    'quantity',
                    '<=',
                    5
                )->take(3)->get();

                @endphp

                <div class="space-y-2 mt-3">

                    @foreach($lowStockProducts as $product)

                        <div class="flex justify-between">

                            <span>

                                {{ $product->name }}

                            </span>

                            <span class="text-red-600 font-bold">

                                {{ $product->quantity }} left

                            </span>

                        </div>

                    @endforeach

                </div>

            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <!-- BAR CHART -->
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h2 class="text-lg font-semibold mb-4">Most Purchased Products</h2>
                <div class="h-64">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- TOP SELLING PRODUCTS -->
            <div class="bg-white p-8 rounded-2xl shadow-lg">

                <h2 class="text-lg font-semibold mb-4">
                    🚚 Delivery Summary
                </h2>

                @php

                $topProducts = \App\Models\Order::selectRaw(
                    'product_id, SUM(quantity) as total_sold'
                )
                ->groupBy('product_id')
                ->with('product')
                ->get()
                ->sortByDesc('total_sold')
                ->take(5);

                $deliveryCount =
                \App\Models\Order::where(
                    'delivery_method',
                    'delivery'
                )->count();

                $pickupCount =
                \App\Models\Order::where(
                    'delivery_method',
                    'pickup'
                )->count();

                @endphp

                @php

                $deliveryCount =
                \App\Models\Order::where(
                    'delivery_method',
                    'delivery'
                )->count();

                $pickupCount =
                \App\Models\Order::where(
                    'delivery_method',
                    'pickup'
                )->count();

                @endphp

                <div class="space-y-4">

                    <div class="flex justify-between border-b pb-3">

                        <span>
                            Home Delivery Orders
                        </span>

                        <span class="font-bold text-blue-600">

                            {{ $deliveryCount }}

                        </span>

                    </div>

                    <div class="flex justify-between border-b pb-3">

                        <span>
                            Self Pickup Orders
                        </span>

                        <span class="font-bold text-green-600">

                            {{ $pickupCount }}

                        </span>

                    </div>

                </div>

                </div>

            </div>

        <!-- Latest Orders -->
        <div class="bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Latest Orders</h2>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">

                        <th class="p-2">Product</th>

                        <th>Customer</th>

                        <th>Delivery</th>

                        <th>Status</th>

                        <th>Total</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach(\App\Models\Order::latest()->take(5)->get() as $order)
                    <tr class="border-b">

                        <td class="p-2">
                            {{ $order->product->name ?? '-' }}
                        </td>

                        <td>
                            {{ $order->fullname }}
                        </td>

                        <td>
                            {{ ucfirst($order->delivery_method) }}
                        </td>

                        <td>

                            @if($order->status == 'Paid')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Paid

                                </span>

                            @elseif($order->status == 'Completed')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Completed

                                </span>

                            @else

                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                    {{ $order->status }}

                                </span>

                            @endif

                        </td>

                        <td class="text-green-600 font-bold">
                            RM {{ number_format($order->total_price,2) }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>



<!-- Chart Script -->
<script>
    // BAR CHART
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',

        data: {

            labels: [

                @foreach($topProducts as $item)

                    "{{ $item->product->name }}",

                @endforeach

            ],

            datasets: [{

                label: 'Units Ordered',

                data: [

                    @foreach($topProducts as $item)

                        {{ $item->total_sold }},

                    @endforeach

                ],

                backgroundColor: '#22c55e',
                borderRadius: 8

            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

</script>

</body>
</html>