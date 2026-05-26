<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-green-800 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">
            🌾 Farmer Panel
        </h2>

        <ul class="space-y-4">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block hover:bg-green-700 p-3 rounded-lg transition">
                    Dashboard
                </a>
            </li>

            <!-- Products -->
            <li>
                <a href="{{ route('products.index') }}"
                   class="block bg-green-700 p-3 rounded-lg">
                    My Products
                </a>
            </li>

            <!-- Orders -->
            <li>
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-green-700 p-3 rounded-lg transition">
                    Customer Orders
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ route('profile.edit') }}"
                   class="block hover:bg-green-700 p-3 rounded-lg transition">
                    Profile
                </a>
            </li>

            <!-- Logout -->
            <li class="pt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left hover:bg-red-600 p-3 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-start mb-6">

            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    Add Product
                </h1>

                <p class="text-gray-500 mt-2">
                    Add new farm products for customers to purchase.
                </p>
            </div>

            <!-- Back Button -->
            <a href="{{ route('products.index') }}"
               class="bg-gray-300 px-5 py-3 rounded-lg hover:bg-gray-400 transition">
                ← Back
            </a>

        </div>

        <!-- Form Card -->
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-2xl">

            <!-- 🔥 IMPORTANT FIX HERE -->
            <form action="{{ route('products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <!-- Product Image -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-gray-700">
                        Product Image
                    </label>

                    <input type="file"
                           name="image"
                           class="w-full border rounded-lg p-3">

                </div>

                <!-- Product Name -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-gray-700">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           placeholder="Example: Fresh Tomato"
                           class="w-full border rounded-lg p-4 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- Category -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-gray-700">
                        Category
                    </label>

                    <select name="category"
                            class="w-full border rounded-lg p-4 focus:ring-2 focus:ring-green-500 outline-none">

                        <option value="">
                            -- Select Category --
                        </option>

                        <option value="Vegetable">
                            Vegetable
                        </option>

                        <option value="Fruit">
                            Fruit
                        </option>

                    </select>

                </div>

                <!-- Quantity -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-gray-700">
                        Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           placeholder="Enter quantity"
                           class="w-full border rounded-lg p-4 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- Unit -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium text-gray-700">
                        Unit
                    </label>

                    <select name="unit"
                            class="w-full border rounded-lg p-4 focus:ring-2 focus:ring-green-500 outline-none">

                        <option value="">
                            -- Select Unit --
                        </option>

                        <option value="kg">
                            kg
                        </option>

                        <option value="bundle">
                            bundle
                        </option>

                        <option value="pack">
                            pack
                        </option>

                        <option value="piece">
                            piece
                        </option>

                    </select>

                </div>

                <!-- Price -->
                <div class="mb-8">

                    <label class="block mb-2 font-medium text-gray-700">
                        Price (RM)
                    </label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           placeholder="Enter product price"
                           class="w-full border rounded-lg p-4 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- Buttons -->
                <div class="flex gap-4">

                    <a href="{{ route('products.index') }}"
                       class="bg-gray-300 px-6 py-3 rounded-lg hover:bg-gray-400 transition">
                        Cancel
                    </a>

                    <button type="submit"
                            class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition shadow">
                        + Add Product
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>