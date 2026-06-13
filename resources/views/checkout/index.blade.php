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
            value="{{ old('fullname', auth()->user()->name) }}"
            placeholder="Full Name"
            class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>

        @error('fullname')
            <p class="text-red-500 text-sm mb-5 mt-1">
                {{ $message }}
            </p>
        @enderror

        <!-- PHONE -->
        <input type="text"
            name="phone"
            value="{{ old('phone') }}"
            placeholder="Phone Number"
            class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>

        @error('phone')
            <p class="text-red-500 text-sm mb-5 mt-1">
                {{ $message }}
            </p>
        @enderror

        <!-- ADDRESS -->
        <textarea
            name="address"
            placeholder="Address"
            rows="4"
            class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>{{ old('address') }}</textarea>

        @error('address')
            <p class="text-red-500 text-sm mb-5 mt-1">
                {{ $message }}
            </p>
        @enderror

        <!-- DELIVERY METHOD -->
        <label class="block text-gray-700 font-semibold mb-2">

            Delivery Method

        </label>

        <div class="mb-6">

            <label class="flex items-center gap-3 mb-3">

                <input
                type="radio"
                name="delivery_method"
                value="pickup"
                checked>

                <span>

                    Self Pickup
                    <span class="text-green-600 text-sm">
                        (Free)
                    </span>

                </span>

            </label>

            <label class="flex items-center gap-3">

                <input
                type="radio"
                name="delivery_method"
                value="delivery">

                <span>

                    Home Delivery
                    <span class="text-gray-500 text-sm">
                        (RM5 Delivery Fee)
                    </span>

                </span>

            </label>

        </div>    

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

            <div class="flex justify-between mb-2">

                <span>Subtotal</span>

                <span>
                    RM {{ number_format($subtotal,2) }}
                </span>

            </div>

            <div class="flex justify-between mb-2">

                <span>Delivery Fee</span>

                <span id="deliveryFee">

                    RM 0.00

                </span>

            </div>

            <div class="flex justify-between mb-2">

                <span>System Service Charge</span>

                <span>
                    RM {{ number_format($serviceCharge,2) }}
                </span>

            </div>

            <hr class="my-4">

            <div class="flex justify-between">

                <span class="text-2xl font-bold">
                    Total
                </span>

                <span
                    id="grandTotal"
                    class="text-3xl font-bold text-green-600">

                    RM {{ number_format($total,2) }}

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

<script>

const pickupRadio =
document.querySelector('input[value="pickup"]');

const deliveryRadio =
document.querySelector('input[value="delivery"]');

const deliveryFeeText =
document.getElementById('deliveryFee');

const grandTotalText =
document.getElementById('grandTotal');

const subtotal = {{ $subtotal }};
const serviceCharge = {{ $serviceCharge }};

function updateTotal() {

    let deliveryFee = 0;

    if (deliveryRadio.checked) {

        deliveryFee = 5;

    }

    let total =
        subtotal +
        serviceCharge +
        deliveryFee;

    deliveryFeeText.innerHTML =
        'RM ' + deliveryFee.toFixed(2);

    grandTotalText.innerHTML =
        'RM ' + total.toFixed(2);
}

pickupRadio.addEventListener(
    'change',
    updateTotal
);

deliveryRadio.addEventListener(
    'change',
    updateTotal
);

updateTotal();

</script>

</body>
</html>