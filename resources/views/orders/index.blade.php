<!DOCTYPE html>
<html>
<head>
    <title>Customer Orders</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-green-800 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">
            🌾 Farmer Panel
        </h2>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    My Products
                </a>
            </li>

            <li>
                <a href="{{ route('orders.index') }}"
                   class="block bg-green-700 p-2 rounded">
                    Customer Orders
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Profile
                </a>
            </li>

            <li class="mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="w-full text-left hover:bg-red-600 p-2 rounded">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Customer Orders
                </h1>

                <p class="text-gray-500">
                    Manage customer purchases and orders here.
                </p>
            </div>

            <a href="{{ route('farmer.dashboard') }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                ← Back
            </a>

        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-green-600 text-white">

                    <tr>

                        <th class="p-4 text-left">Buyer</th>

                        <th class="p-4 text-left">Product</th>

                        <th class="p-4 text-left">Quantity</th>

                        <th class="p-4 text-left">Total</th>

                        <th class="p-4 text-left">Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr class="border-b hover:bg-gray-50">

                            <!-- BUYER NAME -->
                            <td class="p-4 font-medium">

                                {{ $order->buyer->name ?? 'Unknown Buyer' }}

                            </td>

                            <!-- PRODUCT -->
                            <td class="p-4 font-semibold">

                                {{ $order->product->name }}

                            </td>

                            <!-- QUANTITY -->
                            <td class="p-4">

                                {{ $order->quantity }}

                            </td>

                            <!-- TOTAL -->
                            <td class="p-4 text-green-600 font-bold">

                                RM {{ number_format($order->total_price, 2) }}

                            </td>

                            <!-- STATUS -->
                            <td class="p-4">

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Pending
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="p-6 text-center text-gray-500">

                                No customer orders yet.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>