<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-900 text-white p-6 fixed top-0 left-0 h-screen shadow-2xl z-50 overflow-y-auto">

        <div class="mb-10">
            <h1 class="text-3xl font-extrabold">
                🌾 Farmer Panel
            </h1>
        </div>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('farmer.dashboard') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('farmer-products.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    My Products
                </a>
            </li>

            <li>
                <a href="{{ route('harvest-records.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Harvest Records
                </a>
            </li>

            <li>
                <a href="{{ route('reports.index') }}"
                class="block bg-green-700 px-4 py-3 rounded-2xl">
                    Reports
                </a>
            </li>

            <li>
                <a href="{{ route('orders.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Customer Orders
                </a>
            </li>

            <li>
                <a href="{{ url('/farmer/profile') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Profile
                </a>
            </li>

            <li class="pt-8">

                <form method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                    class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold shadow">
                        Logout

                    </button>

                </form>

            </li>

        </ul>

    </div>

    <div class="flex-1 ml-64 p-10">

    <div class="flex justify-between mb-6">

        <h1 class="text-4xl font-bold">
            Sales Report
        </h1>

        <a href="{{ route('farmer.dashboard') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">

            Back Dashboard

        </a>

    </div>

    <div class="grid grid-cols-4 gap-6 mb-8">

        <div class="bg-green-500 text-white p-6 rounded-xl">
            <h3>Total Revenue</h3>
            <p class="text-3xl font-bold">
                RM {{ number_format($totalRevenue,2) }}
            </p>
        </div>

        <div class="bg-blue-500 text-white p-6 rounded-xl">
            <h3>Total Orders</h3>
            <p class="text-3xl font-bold">
                {{ $totalOrders }}
            </p>
        </div>

        <div class="bg-orange-500 text-white p-6 rounded-xl">
            <h3>Total Products Sold</h3>
            <p class="text-3xl font-bold">
                {{ $totalQuantity }}
            </p>
        </div>

        <div class="bg-purple-500 text-white p-6 rounded-xl">
            <h3>Top Product</h3>

            <p class="text-3xl font-bold">
                {{ $topProductName }}
            </p>
        </div>

    </div>

    <table class="w-full bg-white shadow rounded">

        <thead class="bg-green-600 text-white">

            <tr>
                <th class="p-3 text-left">Product</th>
                <th class="p-3 text-left">Quantity</th>
                <th class="p-3 text-left">Revenue</th>
                <th class="p-3 text-left">Date</th>
            </tr>

        </thead>

        <tbody>

            @foreach($orders as $order)

            <tr class="border-b">

                <td class="p-3">
                    {{ $order->product->name }}
                </td>

                <td class="p-3">
                    {{ $order->quantity }}
                </td>

                <td class="p-3">
                    RM {{ number_format($order->total_price,2) }}
                </td>

                <td class="p-3">
                    {{ $order->created_at->format('d M Y') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

    </div>

</div>

</body>
</html>