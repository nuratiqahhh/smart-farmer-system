<!DOCTYPE html>
<html>
<head>
    <title>Add Harvest Record</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto mt-10 bg-white p-10 rounded-3xl shadow-2xl border border-gray-100">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-5xl font-extrabold text-gray-800">
                Add Harvest Record
            </h1>

            <p class="text-gray-500 mt-2">
                Record newly harvested crops for inventory tracking.
            </p>

        </div>

        <a href="{{ route('harvest-records.index') }}"
        class="bg-gray-500 text-white px-5 py-3 rounded-xl hover:bg-gray-600 shadow transition">

            ← Back

        </a>

    </div>

    <div class="bg-green-50 border border-green-200 rounded-2xl p-5 mb-8">

        <h3 class="font-bold text-green-700 mb-2">
            🌾 Harvest Information
        </h3>

        <p class="text-gray-600">
            Enter harvest details to update inventory and track crop production.
        </p>

    </div>

    <form action="{{ route('harvest-records.store') }}"
          method="POST">

        @csrf

        <!-- Product -->

        <div class="mb-4">

            <label class="block text-gray-700 font-semibold">
                Product
            </label>

            <select
                name="product_id"
                class="w-full border border-gray-300 rounded-xl p-4 mt-2 focus:ring-2 focus:ring-green-500 focus:outline-none">

                @foreach($products as $product)

                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                        ({{ $product->grade }})
                    </option>

                @endforeach

            </select>

        </div>

        <!-- Quantity -->

        <div class="mb-4">

            <label class="block text-gray-700 font-semibold">
                Harvest Quantity
            </label>

            <input
                type="number"
                name="harvest_quantity"
                class="w-full border border-gray-300 rounded-xl p-4 mt-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                required>

        </div>

        <!-- Date -->

        <div class="mb-4">

            <label class="block text-gray-700 font-semibold">
                Harvest Date
            </label>

            <input
                type="date"
                name="harvest_date"
                class="w-full border border-gray-300 rounded-xl p-4 mt-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                required>

        </div>

        <!-- Notes -->

        <div class="mb-6">

            <label class="block text-gray-700 font-semibold">
                Notes
            </label>

            <textarea
                name="notes"
                class="w-full border border-gray-300 rounded-xl p-4 mt-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                rows="4"></textarea>

        </div>

        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:scale-105 transition">

            Save Harvest Record

        </button>

    </form>

</div>

</body>
</html>