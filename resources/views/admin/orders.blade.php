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

        <div class="mb-10">

            <h1 class="text-5xl font-extrabold leading-tight text-white">

                Admin<br>Panel

            </h1>

        </div>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-3 rounded-2xl hover:bg-green-800 transition">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products') }}"
                   class="block px-4 py-3 rounded-2xl hover:bg-green-800 transition">
                    Products
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders') }}"
                   class="block px-4 py-3 rounded-2xl bg-green-500 font-semibold">
                    Orders
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users') }}"
                   class="block px-4 py-3 rounded-2xl hover:bg-green-800 transition">
                    Users
                </a>
            </li>

            <li class="mt-10">

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-2xl font-semibold transition">

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

        <!-- SEARCH & FILTER -->

        <div class="bg-white rounded-2xl shadow p-5 mb-6">

            <form method="GET" action="{{ route('admin.orders') }}">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- SEARCH -->
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search customer, phone or product..."
                        class="border rounded-xl px-4 py-3"
                    >

                    <!-- STATUS -->
                    <select
                        name="status"
                        class="border rounded-xl px-4 py-3">

                        <option value="">All Status</option>

                        <option value="Paid"
                            {{ ($status ?? '') == 'Paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                        <option value="Preparing"
                            {{ ($status ?? '') == 'Preparing' ? 'selected' : '' }}>
                            Preparing
                        </option>

                        <option value="Ready for Pickup"
                            {{ ($status ?? '') == 'Ready for Pickup' ? 'selected' : '' }}>
                            Ready for Pickup
                        </option>

                        <option value="Out for Delivery"
                            {{ ($status ?? '') == 'Out for Delivery' ? 'selected' : '' }}>
                            Out for Delivery
                        </option>

                        <option value="Completed"
                            {{ ($status ?? '') == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                    </select>


                    <!-- DELIVERY -->
                    <select
                        name="delivery"
                        class="border rounded-xl px-4 py-3">

                        <option value="">All Delivery</option>

                        <option value="delivery"
                            {{ ($delivery ?? '') == 'delivery' ? 'selected' : '' }}>
                            Home Delivery
                        </option>

                        <option value="pickup"
                            {{ ($delivery ?? '') == 'pickup' ? 'selected' : '' }}>
                            Self Pickup
                        </option>

                    </select>

                </div>


                <!-- BUTTONS -->

                <div class="mt-4 flex gap-3">

                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                        🔍 Search / Filter

                    </button>

                    <a
                        href="{{ route('admin.orders') }}"
                        class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-xl">

                        Clear

                    </a>

                </div>

            </form>

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

            <!-- PAGINATION -->
            <div class="p-4 border-t">
                {{ $orders->withQueryString()->links() }}
            </div>

        </div>

    </div>

</div>

</body>
</html>