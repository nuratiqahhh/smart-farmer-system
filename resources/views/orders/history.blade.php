<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

<!-- NAVBAR -->
<nav class="bg-green-700 text-white shadow-lg">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <h1 class="text-2xl font-bold">
            🌾 Smart Farmer
        </h1>

        <!-- Menu -->
        <div class="flex items-center gap-4">

            <a href="/shop"
               class="hover:text-green-200">
                Shop
            </a>

            <a href="/cart"
               class="hover:text-green-200">
                My Cart
            </a>

            <a href="/my-orders"
               class="font-bold">
                My Orders
            </a>

        </div>

    </div>

</nav>

<!-- CONTENT -->
<div class="max-w-5xl mx-auto py-12 px-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-gray-800 mb-2">
                My Orders
            </h1>

            <p class="text-gray-500 text-lg">
                View your recent purchases and order status.
            </p>

        </div>

        <!-- Back Button -->
        <a href="/shop"
           class="bg-gray-300 px-5 py-3 rounded-xl hover:bg-gray-400 transition">

            ← Back to Shop

        </a>

    </div>

    <!-- Orders -->
    <div class="space-y-6">

        @forelse($orders as $order)

        <div class="bg-white rounded-2xl shadow p-6 flex justify-between items-center">

            <!-- LEFT -->
            <div>

                <!-- Product Name -->
                <h2 class="text-3xl font-bold text-gray-800 mb-2">

                    {{ $order->product->name ?? 'Product' }}

                </h2>

                <!-- Quantity -->
                <p class="text-gray-500 mb-1">

                    Quantity:
                    {{ $order->quantity }}

                </p>

                <!-- Date -->
                <p class="text-gray-500">

                    Order Date:
                    {{ $order->created_at->format('d M Y') }}

                </p>

            </div>

            <!-- RIGHT -->
            <div class="text-right">

                <!-- Price -->
                <p class="text-4xl font-bold text-green-600 mb-3">

                    RM {{ number_format($order->total_price, 2) }}

                </p>

                <!-- Status -->
                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">

                    Paid

                </span>

            </div>

        </div>

        @empty

        <!-- Empty Orders -->
        <div class="bg-white rounded-2xl shadow p-10 text-center">

            <div class="text-7xl mb-4">
                🛒
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-3">
                No Orders Yet
            </h2>

            <p class="text-gray-500 mb-6">
                Start shopping fresh farm products now.
            </p>

            <a href="/shop"
               class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition">

                Go to Shop

            </a>

        </div>

        @endforelse

    </div>

</div>

</body>
</html>