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

        <div class="space-y-5">

            @foreach($carts as $item)

                @php
                    $subtotal = $item->product->price * $item->quantity;
                    $grandTotal += $subtotal;
                @endphp

                <div class="bg-white p-6 rounded-2xl shadow flex justify-between items-center">

                    <!-- PRODUCT INFO -->
                    <div>

                        <h2 class="text-2xl font-bold text-gray-800 mb-1">

                            {{ $item->product->name }}

                        </h2>

                        <p class="text-gray-500">

                            Quantity:
                            <span class="font-semibold">
                                {{ $item->quantity }}
                            </span>

                        </p>

                        <p class="text-green-600 font-bold text-xl mt-3">

                            RM {{ number_format($subtotal, 2) }}

                        </p>

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

        <!-- TOTAL SECTION -->
        <div class="bg-white mt-8 p-6 rounded-2xl shadow">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-2xl font-bold text-gray-800">
                    Total
                </h2>

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