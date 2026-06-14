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
            value="{{ old('phone', auth()->user()->phone) }}"
            placeholder="Phone Number"
            class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
            required>

        @error('phone')
            <p class="text-red-500 text-sm mb-5 mt-1">
                {{ $message }}
            </p>
        @enderror

       <div id="addressSection">

            <label class="block text-gray-700 font-semibold mb-2 mt-4">
                Delivery Address
            </label>

            <button
                type="button"
                id="currentLocationBtn"
                class="mb-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">

                📍 Use Current Location

            </button>

            <input
                type="text"
                id="addressSearch"
                placeholder="Search area, postcode or city (Malaysia)"
                class="w-full border border-gray-300 p-4 rounded-lg mb-2">

            <div
                id="suggestions"
                class="bg-white border rounded-lg shadow hidden mb-3">
            </div>

            <textarea
                id="address"
                name="address"
                placeholder="Use Current Location or Search Address"
                rows="4"
                class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('address', auth()->user()->address) }}</textarea>

            @error('address')
                <p class="text-red-500 text-sm mb-5 mt-1">
                    {{ $message }}

                </p>
            @enderror

        </div>

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

const addressSection =
document.getElementById("addressSection");

const searchBox =
document.getElementById("addressSearch");

const suggestionBox =
document.getElementById("suggestions");

const addressField =
document.getElementById("address");

function toggleAddress(){

    if(deliveryRadio.checked){

        addressSection.style.display = "block";

        addressField.required = true;

    } else {

        addressSection.style.display = "none";

        addressField.required = false;
    }
}

pickupRadio.addEventListener(
    "change",
    toggleAddress
);

deliveryRadio.addEventListener(
    "change",
    toggleAddress
);

toggleAddress();

searchBox.addEventListener("keyup", async function(){

    let keyword = this.value;

    if(keyword.length < 3){

        suggestionBox.classList.add("hidden");
        return;
    }

    const response = await fetch(
        "https://nominatim.openstreetmap.org/search?format=json&countrycodes=my&addressdetails=1&q="
        + encodeURIComponent(keyword)
    );

    const data = await response.json();

    suggestionBox.innerHTML = "";

    data.slice(0,5).forEach(place => {

        const item =
        document.createElement("div");

        item.className =
        "p-3 border-b hover:bg-gray-100 cursor-pointer";

        item.innerText =
        place.display_name;

        item.onclick = function(){

            addressField.value =
            place.display_name;

            searchBox.value =
            place.display_name;

            suggestionBox.classList.add("hidden");
        };

        suggestionBox.appendChild(item);

    });

    suggestionBox.classList.remove("hidden");

});

document
.getElementById("currentLocationBtn")
.addEventListener("click", function(){

    navigator.geolocation.getCurrentPosition(

        async function(position){

            let lat =
            position.coords.latitude;

            let lon =
            position.coords.longitude;

            const response =
            await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`
            );

            const data =
            await response.json();

            addressField.value =
            data.display_name;

            searchBox.value =
            data.display_name;

        },

        function(){

            alert(
                "Unable to get current location."
            );

        }

    );

});

</script>

</body>
</html>