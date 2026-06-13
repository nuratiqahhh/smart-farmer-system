<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmer Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-900 text-white p-6 fixed h-full shadow-2xl">

        <h1 class="text-4xl font-extrabold mb-10 leading-tight">
            🌾 Farmer Panel
        </h1>

        <ul class="space-y-4">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block bg-green-700 hover:bg-green-600 px-4 py-3 rounded-2xl transition font-semibold">
                    Dashboard
                </a>
            </li>

            <!-- Products -->
            <li>
                <a href="{{ route('farmer-products.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    My Products
                </a>
            </li>

            <!-- Harvest Records -->
            <li>
                <a href="{{ route('harvest-records.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    Harvest Records
                </a>
            </li>

            <!-- Reports -->
            <li>
                <a href="{{ route('reports.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    Reports
                </a>
            </li>

            <!-- Orders -->
            <li>
                <a href="{{ route('orders.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    Customer Orders
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ url('/farmer/profile') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    Profile
                </a>
            </li>

            <!-- Logout -->
            <li class="pt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 ml-64 p-10">

        <!-- TOP BAR -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-5xl font-extrabold text-gray-800">
                    Farmer Dashboard
                </h1>

                <p class="text-gray-500 mt-2 text-lg">
                    Welcome back, manage your farm business here.
                </p>
            </div>

            <div class="bg-white shadow px-6 py-4 rounded-2xl">
                <span class="text-gray-600">
                    Welcome,
                </span>

                <span class="font-bold text-green-700">
                    {{ auth()->user()->name }}
                </span>

                <span class="text-sm text-gray-500">
                    (farmer)
                </span>
            </div>

        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">

            <!-- Products -->
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 border-green-500">
                <h3 class="text-gray-500 font-semibold mb-3">
                    My Products
                </h3>

                <p class="text-5xl font-extrabold text-green-600">
                    {{ $productCount }}
                </p>
            </div>

            <!-- Customer Orders -->
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 border-blue-500">
                <h3 class="text-gray-500 font-semibold mb-3">
                    Customer Orders
                </h3>

                <p class="text-5xl font-extrabold text-blue-600">
                    {{ $orderCount }}
                </p>
            </div>

            <!-- Revenue -->
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 border-purple-500">
                <h3 class="text-gray-500 font-semibold mb-3">
                    Revenue
                </h3>

                <p class="text-4xl font-extrabold text-purple-600">
                    RM {{ number_format($revenue, 2) }}
                </p>
            </div>

            <!-- Low Stock -->
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 border-red-500">
                <h3 class="text-gray-500 font-semibold mb-3">
                    Low Stock Products
                </h3>

                <p class="text-5xl font-extrabold text-red-500">
                    {{ $lowStockCount }}
                </p>
            </div>

            <!-- Average -->
            <div class="bg-white rounded-3xl shadow-lg p-6 border-l-8 border-orange-500">
                <h3 class="text-gray-500 font-semibold mb-3">
                    Average Order
                </h3>

                <p class="text-4xl font-extrabold text-orange-500">
                    RM {{ number_format($averageOrder, 2) }}
                </p>
            </div>

        </div>

        <!-- OVERVIEW -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-4">
                Farmer Overview
            </h2>

            <p class="text-gray-600 text-lg leading-relaxed">
                Manage your products, monitor customer purchases,
                track low stock inventory, and analyse your sales
                performance in one dashboard.
            </p>

        </div>

        <!-- ANALYTICS -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

            <div class="flex justify-between items-center mb-6">

                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        📊 Weekly Sales Analytics
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Monitor your weekly sales performance.
                    </p>
                </div>

                <div class="bg-green-100 text-green-700 px-5 py-2 rounded-full font-semibold">
                    Sales Report
                </div>

            </div>

            <div class="h-96">
                <canvas id="salesChart"></canvas>
            </div>

        </div>

        <!-- TOP SELLING -->
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

            <div class="flex justify-between items-center">

                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        🏆 Top Selling Product
                    </h2>

                    <h3 class="text-4xl font-extrabold text-green-600">
                        {{ $topProductName }}
                    </h3>

                    <p class="text-gray-500 mt-2 text-lg">
                        Best selling product in your store
                    </p>
                </div>

                <div class="bg-green-100 text-green-700 px-6 py-3 rounded-full font-bold">
                    {{ $topProductSold }} sold
                </div>

            </div>

        </div>

        <!-- LOW STOCK -->
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h2 class="text-3xl font-bold text-red-500 mb-6">
                ⚠️ Low Stock Alert
            </h2>

            @if($lowStockCount > 0)

                <div class="flex flex-col items-center justify-center py-16">

                    <div class="text-8xl mb-6">
                        ⚠️
                    </div>

                    <h3 class="text-4xl font-extrabold text-red-500 mb-3">
                        {{ $lowStockCount }} Low Stock Products
                    </h3>

                    <p class="text-gray-500 text-lg">
                        Some products need restocking soon.
                    </p>

                    <div class="mt-8 w-full max-w-3xl">

                        <table class="w-full bg-white rounded-xl overflow-hidden">

                            <thead class="bg-red-500 text-white">

                                <tr>
                                    <th class="p-3 text-left">Product</th>
                                    <th class="p-3 text-left">Stock</th>
                                    <th class="p-3 text-left">Status</th>
                                </tr>

                            </thead>

                            <tbody>

                            @foreach($lowStockProducts as $product)

                                <tr class="border-b">

                                    <td class="p-3">
                                        {{ $product->name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $product->quantity }}
                                    </td>

                                    <td class="p-3">

                                        @if($product->quantity <= 2)

                                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full">
                                                Critical
                                            </span>

                                        @else

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                                Low Stock
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            @else

                <div class="flex flex-col items-center justify-center py-16">

                    <div class="text-8xl mb-6">
                        ✅
                    </div>

                    <h3 class="text-4xl font-extrabold text-gray-700 mb-3">
                        No Low Stock Products
                    </h3>

                    <p class="text-gray-500 text-lg">
                        All your inventory levels are healthy.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

<!-- CHART -->
<script>
const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
        label: 'Sales (RM)',
        data: @json($salesData),
            backgroundColor: [
                '#16a34a',
                '#22c55e',
                '#4ade80',
                '#86efac',
                '#0f766e',
                '#14b8a6',
                '#3b82f6'
            ],
            borderRadius: 15
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