<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Farmer Shop</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-green-700 text-white shadow-lg">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <div>
            <h1 class="text-2xl font-bold">
                🌾 Smart Farmer
            </h1>
        </div>

        <!-- Menu -->
        <div class="flex items-center gap-4">

            <!-- Shop -->
            <a href="/shop"
               class="hover:text-green-200">
                Shop
            </a>

            <!-- Cart -->
            <a href="/cart"
               class="hover:text-green-200">
                My Cart
            </a>

            <!-- Orders -->
            <a href="/my-orders"
               class="hover:text-green-200">
                My Orders
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="bg-green-600 text-white py-16">

    <div class="max-w-7xl mx-auto px-6">

        <h1 class="text-5xl font-bold mb-4">
            Fresh Farm Products
        </h1>

        <p class="text-xl text-green-100">
            Buy directly from local farmers near you.
        </p>

    </div>

</section>

<!-- SEARCH -->
<div class="max-w-7xl mx-auto px-6 mt-8">

    <form method="GET"
          action="/shop"
          class="bg-white p-4 rounded-xl shadow flex gap-4">

        <input type="text"
               name="search"
               placeholder="Search products..."
               value="{{ request('search') }}"
               class="flex-1 border rounded-lg p-3">

        <button
            class="bg-green-600 text-white px-6 rounded-lg hover:bg-green-700">

            Search

        </button>

    </form>

</div>

<!-- PRODUCTS -->
<div class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-3xl font-bold mb-8">
        Available Products
    </h2>

    <!-- NO PRODUCTS -->
    @if($products->count() == 0)

        <div class="bg-white rounded-2xl shadow-lg p-10 text-center">

            <div class="text-7xl mb-4">
                🔍
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-3">
                No Products Found
            </h2>

            <p class="text-gray-500">
                Try searching another product.
            </p>

        </div>

    @endif

    <!-- PRODUCT GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        @foreach($products as $product)

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition">

            <!-- PRODUCT IMAGE -->
            <img src="{{ asset('products/' . $product->image) }}"
                 class="w-full h-60 object-cover">

            <!-- CONTENT -->
            <div class="p-5">

                <!-- CATEGORY -->
                <div class="mb-2">

                    <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
                        {{ $product->category }}
                    </span>

                </div>

                <!-- PRODUCT NAME -->
                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    {{ $product->name }}
                </h3>

                <!-- STOCK -->
                <p class="text-gray-500 mb-2">
                    Stock:
                    {{ $product->quantity }}
                    {{ $product->unit }}
                </p>

                <!-- LOW STOCK -->
                @if($product->quantity <= 5 && $product->quantity > 0)

                    <p class="text-red-500 font-semibold mb-3">
                        ⚠ Low Stock
                    </p>

                @endif

                <!-- OUT OF STOCK -->
                @if($product->quantity <= 0)

                    <p class="text-red-700 font-bold mb-3">
                        Out of Stock
                    </p>

                @endif

                <!-- SELLER -->
                <p class="text-gray-500 mb-4">
                    Seller:
                    {{ $product->user->name ?? 'Farmer' }}
                </p>

                <!-- PRICE + BUTTON -->
                <div class="flex justify-between items-center">

                    <!-- PRICE -->
                    <p class="text-2xl font-bold text-green-600">
                        RM {{ number_format($product->price, 2) }}
                    </p>

                    <!-- BUTTON -->
                    @if($product->quantity > 0)

                    <form action="{{ route('cart.add', $product->id) }}"
                          method="POST">

                        @csrf

                        <button
                            class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">

                            Add to Cart

                        </button>

                    </form>

                    @else

                    <button
                        class="bg-gray-400 text-white px-5 py-2 rounded-lg cursor-not-allowed">

                        Unavailable

                    </button>

                    @endif

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>