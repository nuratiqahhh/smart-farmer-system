<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-900 text-white p-6 fixed top-0 left-0 h-screen shadow-2xl z-50 overflow-y-auto">

        <!-- LOGO -->
        <div class="mb-10">

            <h1 class="text-3xl font-extrabold leading-tight">
                🌾 Farmer Panel
            </h1>

        </div>

        <!-- MENU -->
        <ul class="space-y-4">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition font-medium">
                    Dashboard
                </a>
            </li>

            <!-- Products -->
            <li>
                <a href="{{ route('farmer-products.index') }}"
                   class="block bg-green-700 px-4 py-3 rounded-2xl transition font-semibold shadow">
                    My Products
                </a>
            </li>

            <!-- Orders -->
            <li>
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition font-medium">
                    Customer Orders
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ url('/farmer/profile') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition font-medium">
                    Profile
                </a>
            </li>

            <!-- Logout -->
            <li class="pt-8">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold shadow">
                        Logout
                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 ml-64 p-10">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-5xl font-extrabold text-gray-800">
                    Add Product
                </h1>

                <p class="text-gray-500 mt-2 text-lg">
                    Add fresh vegetables and fruits for customers.
                </p>

            </div>

            <!-- BACK BUTTON -->
            <a href="{{ route('farmer-products.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-2xl transition font-semibold shadow">
                ← Back
            </a>

        </div>

        <!-- ERROR MESSAGE -->
        @if ($errors->any())

            <div class="bg-red-100 border border-red-300 text-red-700 px-6 py-4 rounded-2xl mb-6 shadow">

                <ul class="list-disc pl-6">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- FORM CARD -->
        <div class="bg-white p-10 rounded-3xl shadow-2xl max-w-4xl">

            <form action="{{ route('farmer-products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <!-- PRODUCT IMAGE -->
                <div class="mb-8">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Product Image
                    </label>

                    <input type="file"
                           name="image"
                           required
                           class="w-full border border-gray-300 rounded-2xl p-4 bg-gray-50 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- PRODUCT NAME -->
                <div class="mb-8">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           required
                           placeholder="Example: Tomato, Apple, Kangkung"
                           class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- CATEGORY -->
                <div class="mb-8">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Category
                    </label>

                    <select name="category"
                            required
                            class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-green-500 outline-none">

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

                <!-- PRODUCT GRADE -->
                <div class="mb-8">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Product Grade
                    </label>

                    <select name="grade"
                            required
                            class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-yellow-400 outline-none">

                        <option value="">
                            -- Select Grade --
                        </option>

                        <option value="A">
                            Grade A
                        </option>

                        <option value="B">
                            Grade B
                        </option>

                    </select>

                    <!-- GRADE INFO -->
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-5 rounded-2xl mt-4">

                        <h3 class="font-bold text-lg mb-3">
                            🌟 Product Grade Information
                        </h3>

                        <p class="mb-2 leading-relaxed">
                            <strong>Grade A:</strong>
                            Premium quality products that are fresher,
                            bigger in size, and have better appearance.
                        </p>

                        <p class="leading-relaxed">
                            <strong>Grade B:</strong>
                            Standard quality products that may be smaller
                            in size or less attractive but still suitable
                            for daily use and consumption.
                        </p>

                    </div>

                </div>

                <!-- QUANTITY -->
                <div class="mb-8">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           required
                           placeholder="Enter quantity"
                           class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- UNIT -->
                <div class="mb-8">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Unit
                    </label>

                    <select name="unit"
                            required
                            class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-green-500 outline-none">

                        <option value="">
                            -- Select Unit --
                        </option>

                        <option value="kg">
                            kg
                        </option>

                        <option value="item">
                            item
                        </option>

                        <option value="bundle">
                            bundle
                        </option>

                    </select>

                </div>

                <!-- PRICE -->
                <div class="mb-10">

                    <label class="block mb-3 font-bold text-gray-700 text-lg">
                        Price (RM)
                    </label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           required
                           placeholder="Enter product price"
                           class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-green-500 outline-none">

                </div>

                <!-- BUTTONS -->
                <div class="flex gap-4">

                    <!-- CANCEL -->
                    <a href="{{ route('farmer-products.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-4 rounded-2xl transition font-semibold shadow">
                        Cancel
                    </a>

                    <!-- SUBMIT -->
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl transition font-semibold shadow-lg">
                        + Add Product
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>