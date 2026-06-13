<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Farmer Shop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-green-800 text-white shadow-xl sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">

        <!-- LOGO -->
        <div>

            <h1 class="text-3xl font-extrabold tracking-wide">
                🌾 Smart Farmer
            </h1>

        </div>

        <!-- MENU -->
        <div class="flex items-center gap-6 text-base font-semibold">

            <!-- Shop -->
            <a href="/shop"
               class="hover:text-green-200 transition">
                Shop
            </a>

            <!-- Cart -->
            <a href="/cart"
            class="hover:text-green-200 transition flex items-center gap-2">

                🛒 My Cart

                @if(isset($cartCount) && $cartCount > 0)

                    <span
                        class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow">

                        {{ $cartCount }}

                    </span>

                @endif

            </a>

            <!-- Orders -->
            <a href="/my-orders"
               class="hover:text-green-200 transition">
                My Orders
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button
                    class="bg-red-500 px-5 py-2 rounded-xl hover:bg-red-600 transition shadow-lg">
                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>


<!-- HERO SECTION -->
<section class="bg-gradient-to-r from-green-700 to-green-500 text-white py-20 shadow-lg">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h1 class="text-5xl md:text-6xl font-extrabold mb-4">

            🌱 Farm Fresh Marketplace

        </h1>

        <p class="text-xl text-green-100">

            Fresh vegetables and fruits from trusted local farmers.

        </p>

        <p class="mt-4 text-green-200">

            Premium Quality • Fresh Harvest • Direct From Farmers

        </p>

    </div>

</section>

<!-- SEARCH -->
<div class="max-w-7xl mx-auto px-6 mt-10">

    <form method="GET"
          action="/shop"
          class="bg-white p-4 rounded-2xl shadow-lg flex gap-4">

        <input type="text"
               name="search"
               placeholder="Search vegetables or fruits..."
               value="{{ request('search') }}"
               class="flex-1 border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 outline-none">

        <button
            class="bg-green-600 text-white px-8 rounded-xl hover:bg-green-700 transition font-semibold shadow">

            Search

        </button>

    </form>

</div>

<!-- MAIN CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- GRADE INFO -->
    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-5 rounded-2xl mb-8 shadow-sm">

        <h3 class="font-bold text-lg mb-3">
            🌟 Product Grade Information
        </h3>

        <p class="mb-2 leading-relaxed">
            <strong>Grade A:</strong>
            Premium and fresher quality products with better appearance and size.
        </p>

        <p class="leading-relaxed">
            <strong>Grade B:</strong>
            Standard quality products suitable for normal daily use.
        </p>

    </div>

    <!-- TITLE -->
    <h2 class="text-4xl font-extrabold text-gray-800 mb-8">
        Available Products
    </h2>

    <!-- NO PRODUCTS -->
    @if($products->count() == 0)

        <div class="bg-white rounded-3xl shadow-xl p-12 text-center">

            <div class="text-7xl mb-5">
                🔍
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-3">
                No Products Found
            </h2>

            <p class="text-gray-500 text-lg">
                Try searching another product.
            </p>

        </div>

    @endif

    <!-- PRODUCT GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($products as $product)

        <!-- PRODUCT CARD -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col h-full">

            <!-- IMAGE -->
            <div class="relative">

                <img src="{{ asset('products/' . $product->image) }}"
                     class="w-full h-64 object-cover">

                <!-- CATEGORY -->
                <div class="absolute top-4 left-4">

                    <span class="bg-white/90 text-green-700 text-sm px-4 py-2 rounded-full font-semibold shadow">

                        {{ $product->category }}

                    </span>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-6 flex flex-col flex-grow">

                <!-- PRODUCT NAME -->
                <h3 class="text-3xl font-extrabold text-gray-800 mb-4">

                    {{ $product->name }}

                </h3>

                <!-- GRADE -->
                <div class="mb-4">

                    @if($product->grade == 'A')

                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold shadow-sm">
                            🌟 Grade A
                        </span>

                    @else

                        <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-bold shadow-sm">
                            🌟 Grade B
                        </span>

                    @endif

                </div>

                <!-- STOCK -->
                <div class="mb-4">

                    <p class="text-gray-600 text-lg">

                        Available Stock:
                        <span class="font-bold text-gray-800">

                            {{ $product->quantity }}
                            {{ $product->unit }}

                        </span>

                    </p>

                    <!-- LOW STOCK -->
                    @if($product->quantity <= 5 && $product->quantity > 0)

                        <p class="text-red-500 font-semibold mt-2">
                            ⚠ Low Stock
                        </p>

                    @endif

                </div>

                <!-- FARMER -->
                <div class="mb-5">

                    <p class="text-gray-500 text-sm">

                        Farmer:

                        <span class="font-semibold text-gray-700">

                            {{ $product->user->name ?? 'Farmer' }}

                        </span>

                    </p>

                </div>


                <!-- PRICE -->
                <div class="mt-auto mb-6">

                    <span class="text-4xl font-extrabold text-green-600">

                        RM {{ number_format($product->price, 2) }}

                    </span>

                    <span class="text-gray-500 font-medium">

                        per {{ $product->unit }}

                    </span>

                </div>

                <!-- ADD TO CART -->
                <form action="{{ route('cart.add', $product->id) }}"
                    method="POST">

                    @csrf

                    <!-- Quantity -->
                    <label class="block text-gray-600 font-semibold mb-1">

                        Purchase Quantity ({{ $product->unit }})

                    </label>

                    <p class="text-xs text-gray-500 mb-2">

                        @if($product->unit == 'kg')

                            Sold by Weight

                        @elseif($product->unit == 'bundle')

                            Sold per Bundle

                        @else

                            Sold per Item

                        @endif

                    </p>

                    @if($product->unit == 'kg')

                        <p class="text-xs text-green-600 mb-3">

                            Example:
                            2 kg = RM {{ number_format($product->price * 2, 2) }}

                        </p>

                    @endif

                    <input type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $product->quantity }}"
                        class="w-full border border-gray-300 rounded-xl p-3 mb-4">

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-2xl font-bold text-lg transition shadow-lg">

                        🛒 Add to Cart

                    </button>

                </form>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>