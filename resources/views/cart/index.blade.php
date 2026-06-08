<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-4xl font-bold text-gray-800">
            🛒 My Cart
        </h1>

        <a href="/shop"
           class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400 transition">

            ← Continue Shopping

        </a>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">

            {{ session('success') }}

        </div>

    @endif

    @php
        $grandTotal = 0;
    @endphp

    <!-- CART ITEMS -->
    @if($carts->count() > 0)

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- LEFT SIDE -->
            <div class="lg:col-span-2 space-y-5">

            @foreach($carts as $item)

                @php
                    $subtotal = $item->product->price * $item->quantity;
                    $grandTotal += $subtotal;
                @endphp

                <div class="bg-white p-6 rounded-2xl shadow flex justify-between items-center">

                    <!-- PRODUCT INFO -->
                    <div class="flex items-center gap-5">

                        <img src="{{ asset('products/' . $item->product->image) }}"
                            class="w-24 h-24 object-cover rounded-2xl shadow">

                        <div>

                            <h2 class="text-2xl font-bold text-gray-800 mb-1">

                                {{ $item->product->name }}

                            </h2>

                            <div class="flex gap-2 mt-2">

                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">

                                    Grade {{ $item->product->grade }}

                                </span>

                            </div>

                            <p class="text-gray-500 mt-2">

                                Quantity:
                                <span class="font-semibold">

                                    {{ $item->quantity }}

                                    {{ $item->product->unit }}

                                </span>

                            </p>
                            
                            <p class="text-green-600 font-bold text-xl mt-3">

                                RM {{ number_format($subtotal, 2) }}

                            </p>

                        </div>

                    </div>


                    <!-- REMOVE BUTTON -->
                    <form action="{{ route('cart.remove', $item->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition">

                            Remove

                        </button>

                    </form>

                </div>

            @endforeach

        </div>

        <!-- RIGHT SIDE -->
        <div>

        <!-- ORDER SUMMARY -->
        <div class="bg-white p-6 rounded-2xl shadow sticky top-24">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">

                📋 Order Summary

            </h2>

            <div class="space-y-4">

                <div class="flex justify-between">

                    <span class="text-gray-600">
                        Products
                    </span>

                    <span class="font-semibold">
                        {{ $carts->count() }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-gray-600">
                        Total Units
                    </span>

                    <span class="font-semibold">
                        {{ $carts->sum('quantity') }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-gray-600">
                        Subtotal
                    </span>

                    <span class="font-semibold">

                        RM {{ number_format($grandTotal, 2) }}

                    </span>

                </div>

                <hr>

                <div class="flex justify-between items-center">

                    <span class="text-lg font-bold">
                        Grand Total
                    </span>

                    <span class="text-3xl font-bold text-green-600">

                        RM {{ number_format($grandTotal, 2) }}

                    </span>

                </div>

            <!-- CHECKOUT BUTTON -->
            <a href="{{ route('checkout.index') }}"
               class="block w-full bg-green-600 text-white text-center py-4 rounded-xl font-semibold text-lg hover:bg-green-700 transition">

                Proceed to Checkout

            </a>

        </div>

    @else

        <!-- EMPTY CART -->
        <div class="bg-white p-10 rounded-2xl shadow text-center">

            <h2 class="text-2xl font-bold text-gray-700 mb-3">

                Your cart is empty 🛒

            </h2>

            <p class="text-gray-500 mb-6">

                Looks like you haven't added any products yet.

            </p>

            <a href="/shop"
               class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">

                Start Shopping

            </a>

        </div>

    @endif

</div>

</body>
</html>