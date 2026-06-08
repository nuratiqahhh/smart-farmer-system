<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen py-10">

<div class="max-w-6xl mx-auto">

    <!-- Back Button -->
    <a href="{{ route('farmer-products.index') }}"
       class="inline-flex items-center bg-white px-5 py-3 rounded-xl shadow mb-6 hover:shadow-lg transition">

        ← Back to Products

    </a>

    <!-- Header -->
    <div class="mb-8">

        <h1 class="text-5xl font-extrabold text-green-700">
            🌱 Edit Product
        </h1>

        <p class="text-gray-500 mt-3 text-lg">
            Manage product details, stock quantity and pricing information.
        </p>

    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-6">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT SIDE -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-2xl">

            <form method="POST"
                  action="{{ route('farmer-products.update', $product->id) }}">

                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $product->name }}"
                           required
                           class="w-full border border-gray-300 rounded-xl p-3">

                </div>

                <!-- Category -->
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Category
                    </label>

                    <select name="category"
                            class="w-full border border-gray-300 rounded-xl p-3">

                        <option value="Vegetable"
                            {{ $product->category == 'Vegetable' ? 'selected' : '' }}>
                            Vegetable
                        </option>

                        <option value="Fruit"
                            {{ $product->category == 'Fruit' ? 'selected' : '' }}>
                            Fruit
                        </option>

                    </select>

                </div>

                <!-- Grade -->
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Product Grade
                    </label>

                    <select name="grade"
                            class="w-full border border-gray-300 rounded-xl p-3">

                        <option value="A"
                            {{ $product->grade == 'A' ? 'selected' : '' }}>
                            Grade A
                        </option>

                        <option value="B"
                            {{ $product->grade == 'B' ? 'selected' : '' }}>
                            Grade B
                        </option>

                    </select>

                </div>

                <!-- Quantity -->
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           value="{{ $product->quantity }}"
                           required
                           class="w-full border border-gray-300 rounded-xl p-3">

                </div>

                <!-- Unit -->
                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Unit
                    </label>

                    <select name="unit"
                            class="w-full border border-gray-300 rounded-xl p-3">

                        <option value="kg"
                            {{ $product->unit == 'kg' ? 'selected' : '' }}>
                            kg
                        </option>

                        <option value="bundle"
                            {{ $product->unit == 'bundle' ? 'selected' : '' }}>
                            bundle
                        </option>

                        <option value="item"
                            {{ $product->unit == 'item' ? 'selected' : '' }}>
                            item
                        </option>

                    </select>

                </div>

                <!-- Price -->
                <div class="mb-8">

                    <label class="block font-semibold mb-2">
                        Price (RM)
                    </label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           value="{{ $product->price }}"
                           required
                           class="w-full border border-gray-300 rounded-xl p-3">

                </div>

                <!-- Buttons -->
                <div class="flex gap-4">

                    <a href="{{ route('farmer-products.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                    <button type="submit"
                        class="bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white px-6 py-3 rounded-xl shadow-xl">

                        Update Product

                    </button>

                </div>

            </form>

        </div>

        <!-- RIGHT SIDE -->
        <div class="bg-white p-8 rounded-3xl shadow-2xl">

            <h2 class="text-2xl font-bold text-green-700 mb-6">
                Product Summary
            </h2>

            <div class="text-center mb-6">

                <img src="{{ asset('products/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-40 h-40 object-cover rounded-3xl shadow-xl mx-auto">

                <h3 class="mt-4 text-2xl font-bold text-gray-800">
                    {{ $product->name }}
                </h3>

            </div>

            <div class="space-y-4 text-gray-700">

                <div>
                    <span class="font-semibold">Category:</span>
                    {{ $product->category }}
                </div>

                <div>
                    <span class="font-semibold">Grade:</span>
                    Grade {{ $product->grade }}
                </div>

                <div>
                    <span class="font-semibold">Stock:</span>
                    {{ $product->quantity }} {{ $product->unit }}
                </div>

                <div>
                    <span class="font-semibold">Price:</span>
                    RM {{ number_format($product->price, 2) }}
                </div>

            </div>

            <hr class="my-6">

            <div class="bg-green-50 border border-green-200 rounded-2xl p-4">

                <p class="text-green-700 font-semibold">
                    🌱 Product Information
                </p>

                <p class="text-sm text-gray-600 mt-2">
                    Keep your stock quantity and pricing updated so buyers can see the latest product information.
                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>