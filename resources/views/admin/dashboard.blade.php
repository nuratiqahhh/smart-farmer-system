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
    <div class="w-64 bg-green-900 text-white p-6 fixed h-full shadow-2xl">
        <h1 class="text-4xl font-extrabold mb-10 leading-tight">
            Admin Panel
        </h1>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                class="block bg-green-700 hover:bg-green-600 px-4 py-3 rounded-2xl transition font-semibold">

                    Dashboard

                </a>
            </li>

            <li>
                <a href="{{ route('admin.products') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">

                    Products

                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">

                    Orders

                </a>
            </li>

            <li>
                <a href="{{ route('admin.users') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">

                    Users

                </a>
            </li>
            <li class="mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                    class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main -->
    <div class="flex-1 ml-64 p-10">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-5xl font-extrabold text-gray-800">
                    Admin Dashboard
                </h1>

                <p class="text-gray-500 mt-2 text-lg">
                    Manage users, products and transactions.
                </p>

            </div>

            <div class="bg-white shadow px-6 py-4 rounded-2xl">

                <span class="text-gray-500">
                    Welcome,
                </span>

                <span class="font-bold text-green-700">
                    {{ auth()->user()->name }}
                </span>

                <span class="text-sm text-gray-400">
                    (Admin)
                </span>

            </div>

        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-10">

            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 hover:shadow-xl transition duration-300">
                <h3>Total Products</h3>
                <p class="text-2xl text-green-700 font-bold">
                    {{ $productCount }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 hover:shadow-xl transition duration-300">
                <h3>Total Orders</h3>
                <p class="text-2xl text-blue-600 font-bold">
                    {{ $orderCount }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 hover:shadow-xl transition duration-300">
                <h3>Total Users</h3>
                <p class="text-2xl text-purple-600 font-bold">
                    {{ $userCount }}
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 hover:shadow-xl transition duration-300">
                <h3>Total Transaction Value (RM)</h3>
                <p class="text-2xl text-red-600 font-bold">
                    RM {{ number_format($totalRevenue, 2) }}
                </p>
            </div>

           <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 hover:shadow-xl transition duration-300">

                <h3>Low Stock Alert</h3>


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

        <!-- Today's Analytics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <!-- Today's Sales -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h3 class="text-gray-500 font-semibold">
                    Today's Sales
                </h3>

                <p class="text-3xl font-bold text-green-600 mt-2">
                    RM {{ number_format($todaySales, 2) }}
                </p>
            </div>

            <!-- Today's Orders -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h3 class="text-gray-500 font-semibold">
                    Today's Orders
                </h3>

                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $todayOrders }}
                </p>
            </div>

            <!-- Top Customer -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h3 class="text-gray-500 font-semibold">
                    Top Customer
                </h3>

                <p class="text-xl font-bold text-purple-600 mt-2">
                    {{ $topCustomer->name ?? 'No Customer Yet' }}
                </p>
            </div>

        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <!-- BAR CHART -->
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 hover:shadow-xl transition duration-300">
                <h2 class="text-lg font-semibold mb-4">Most Purchased Products</h2>
                <div class="h-64">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- TOP SELLING PRODUCTS -->
            <div class="bg-white p-8 rounded-3xl shadow-md hover:shadow-xl transition duration-300">

                <h2 class="text-lg font-semibold mb-4">
                    Delivery Summary
                </h2>

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
        <div class="bg-white p-8 rounded-3xl shadow-md hover:shadow-xl transition duration-300">
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
                    @foreach($latestOrders as $order)
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

        <div class="bg-white p-8 rounded-3xl shadow-md mt-8">

            <h2 class="text-xl font-bold mb-5">
                Recent Activity
            </h2>

            <div class="space-y-4">

                @foreach($recentActivities as $activity)

                    <div class="flex justify-between border-b pb-3">

                        <div>

                            <p class="font-semibold">
                                Order #{{ $activity->id }} -
                                {{ $activity->product->name ?? '-' }}
                            </p>

                            <p class="text-gray-500 text-sm">
                                {{ $activity->fullname }}
                            </p>

                        </div>

                        <div class="text-right">

                            <span class="text-green-600 font-semibold">
                                {{ $activity->status }}
                            </span>

                            <p class="text-gray-400 text-sm">
                                {{ $activity->created_at->diffForHumans() }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

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