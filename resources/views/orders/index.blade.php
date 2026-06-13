<!DOCTYPE html>
<html>
<head>
    <title>Customer Orders</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
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
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">

                    Reports

                </a>
            </li>

            <li>
                <a href="{{ route('orders.index') }}"
                   class="block bg-green-700 px-4 py-3 rounded-2xl">
                    Customer Orders
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Profile
                </a>
            </li>

            <li class="pt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl text-left font-semibold">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-10">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-5xl font-extrabold text-gray-900">
                    Customer Orders
                </h1>

                <p class="text-gray-500 text-lg mt-2">
                    Manage customer purchases and orders here.
                </p>
            </div>

            <a href="{{ route('farmer.dashboard') }}"
               class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl font-semibold">
                ← Back
            </a>

        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-green-600 text-white">

                    <tr>
                        <th class="p-4 text-left">Customer</th>
                        <th class="p-4 text-left">Phone</th>
                        <th class="p-4 text-left">Product</th>
                        <th class="p-4 text-left">Quantity</th>
                        <th class="p-4 text-left">Delivery</th>
                        <th class="p-4 text-left">Address</th>
                        <th class="p-4 text-left">Payment</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr class="border-b hover:bg-gray-50">

                            <!-- CUSTOMER -->
                            <td class="p-4 font-medium">

                                {{ $order->fullname }}

                            </td>

                            <!-- PHONE -->
                            <td class="p-4">

                                {{ $order->phone }}

                            </td>

                            <!-- PRODUCT -->
                            <td class="p-4 font-semibold">

                                {{ $order->product->name }}

                            </td>

                            <!-- QUANTITY -->
                            <td class="p-4">

                                {{ $order->quantity }}

                            </td>

                            <!-- DELIVERY -->
                            <td class="p-4">

                                {{ ucfirst($order->delivery_method) }}

                            </td>

                            <!-- ADDRESS -->
                            <td class="p-4">

                                {{ $order->address }}

                            </td>

                            <!-- PAYMENT -->
                            <td class="p-4">

                                {{ $order->payment_method }}

                            </td>

                            <!-- STATUS -->
                            <td class="p-4">

                                @if($order->status == 'Paid')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Paid
                                    </span>

                                @elseif($order->status == 'Completed')

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        Completed
                                    </span>

                                @else

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Pending
                                    </span>

                                @endif

                            </td>

                            <!-- ACTION -->
                            <td class="p-4">

                                @if($order->status == 'Paid')

                                    <form action="{{ route('orders.complete', $order->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">

                                            Complete

                                        </button>

                                    </form>

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="p-6 text-center text-gray-500">

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