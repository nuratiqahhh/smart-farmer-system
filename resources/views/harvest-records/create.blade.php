<!DOCTYPE html>
<html>
<head>
    <title>Add Harvest Record</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Add Harvest Record
        </h1>

        <a href="{{ route('harvest-records.index') }}"
        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">

            ← Back

        </a>

    </div>

    <form action="{{ route('harvest-records.store') }}"
          method="POST">

        @csrf

        <!-- Product -->

        <div class="mb-4">

            <label class="font-semibold">
                Product
            </label>

            <select
                name="product_id"
                class="w-full border rounded-lg p-3 mt-2">

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

            <label class="font-semibold">
                Harvest Quantity
            </label>

            <input
                type="number"
                name="harvest_quantity"
                class="w-full border rounded-lg p-3 mt-2"
                required>

        </div>

        <!-- Date -->

        <div class="mb-4">

            <label class="font-semibold">
                Harvest Date
            </label>

            <input
                type="date"
                name="harvest_date"
                class="w-full border rounded-lg p-3 mt-2"
                required>

        </div>

        <!-- Notes -->

        <div class="mb-6">

            <label class="font-semibold">
                Notes
            </label>

            <textarea
                name="notes"
                class="w-full border rounded-lg p-3 mt-2"
                rows="4"></textarea>

        </div>

        <button
            type="submit"
            class="bg-green-600 text-white px-6 py-3 rounded-lg">

            Save Harvest Record

        </button>

    </form>

</div>

</body>
</html>