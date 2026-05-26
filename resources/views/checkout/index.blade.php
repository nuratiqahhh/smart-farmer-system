<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

    <!-- TITLE -->
    <h1 class="text-4xl font-bold text-gray-800 mb-8">
        Checkout
    </h1>

    <form action="{{ route('checkout.store') }}" method="POST">

        @csrf

        <!-- FULL NAME -->
        <input type="text"
               name="fullname"
               placeholder="Full Name"
               class="w-full border border-gray-300 p-4 rounded-lg mb-5 focus:outline-none focus:ring-2 focus:ring-green-500"
               required>

        <!-- PHONE -->
        <input type="text"
               name="phone"
               placeholder="Phone Number"
               class="w-full border border-gray-300 p-4 rounded-lg mb-5 focus:outline-none focus:ring-2 focus:ring-green-500"
               required>

        <!-- ADDRESS -->
        <textarea
            name="address"
            placeholder="Address"
            rows="4"
            class="w-full border border-gray-300 p-4 rounded-lg mb-5 focus:outline-none focus:ring-2 focus:ring-green-500"
            required></textarea>

        <!-- PAYMENT METHOD -->
        <select
            name="payment_method"
            class="w-full border border-gray-300 p-4 rounded-lg mb-8 focus:outline-none focus:ring-2 focus:ring-green-500">

            <option>Online Banking</option>
            <option>Touch n Go</option>
            <option>Debit Card</option>

        </select>

        <!-- ORDER SUMMARY -->
        <div class="bg-gray-100 p-6 rounded-xl mb-8">

            <h2 class="text-2xl font-bold mb-5 text-gray-800">
                Order Summary
            </h2>

            @foreach($carts as $item)

                <div class="flex justify-between mb-3 text-gray-700">

                    <span>
                        {{ $item->product->name }}
                        x {{ $item->quantity }}
                    </span>

                    <span>
                        RM {{ number_format($item->product->price * $item->quantity, 2) }}
                    </span>

                </div>

            @endforeach

            <hr class="my-5">

            <div class="flex justify-between items-center">

                <span class="text-2xl font-bold text-gray-800">
                    Total
                </span>

                <span class="text-3xl font-bold text-green-600">

                    RM {{ number_format($total, 2) }}

                </span>

            </div>

        </div>

        <!-- BUTTONS -->
        <div class="flex gap-4">

            <!-- BACK BUTTON -->
            <a href="/cart"
               class="w-1/2 bg-gray-300 text-center py-4 rounded-xl font-semibold hover:bg-gray-400 transition">

                ← Back to Cart

            </a>

            <!-- PAY BUTTON -->
            <button
                class="w-1/2 bg-green-600 text-white py-4 rounded-xl font-semibold hover:bg-green-700 transition">

                Pay Now

            </button>

        </div>

    </form>

</div>

</body>
</html>