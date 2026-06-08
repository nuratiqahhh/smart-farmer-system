<!DOCTYPE html>
<html>
<head>
    <title>All Orders (Admin)</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-green-800 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">
            👨‍💼 Admin Panel
        </h2>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Products
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders') }}"
                   class="block bg-green-700 p-2 rounded">
                    Orders
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Users
                </a>
            </li>

            <li class="mt-10">

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button
                        class="w-full text-left hover:bg-red-600 p-2 rounded">

                        Logout

                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">

        <div class="flex justify-between items-center mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    All Orders
                </h1>

                <p class="text-gray-500">
                    Monitor all customer orders in the system.
                </p>

            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">

                ← Back

            </a>

        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

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

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                {{ $order->fullname }}
                            </td>

                            <td class="p-4">
                                {{ $order->phone }}
                            </td>

                            <td class="p-4">
                                {{ $order->product->name ?? '-' }}
                            </td>

                            <td class="p-4">
                                {{ $order->quantity }}
                            </td>

                            <td class="p-4">
                                {{ ucfirst($order->delivery_method) }}
                            </td>

                            <td class="p-4">
                                {{ $order->address }}
                            </td>

                            <td class="p-4">
                                {{ $order->payment_method }}
                            </td>

                            <td class="p-4">

                                @if($order->status == 'Completed')

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                        Completed
                                    </span>

                                @elseif($order->status == 'Paid')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Paid
                                    </span>

                                @else

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Pending
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="p-6 text-center text-gray-500">

                                No orders found.

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