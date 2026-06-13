<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>

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
                <a href="{{ route('harvest-records.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition font-medium">

                    Harvest Records

                </a>
            </li>

            <li>
                <a href="{{ route('reports.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition font-medium">

                    Reports

                </a>
            </li>
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
                    My Products
                </h1>

                <p class="text-gray-500 mt-2 text-lg">
                    Manage all your vegetables and fruits here.
                </p>

            </div>

            <!-- ADD PRODUCT BUTTON -->
            <a href="{{ route('farmer-products.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-lg transition font-semibold">
                + Add Product
            </a>

        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-2xl mb-6 shadow">

                {{ session('success') }}

            </div>

        @endif

        <!-- PRODUCT TABLE -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full min-w-full">

                    <!-- TABLE HEADER -->
                    <thead class="bg-green-700 text-white">

                        <tr>

                            <th class="px-6 py-5 text-left text-sm uppercase tracking-wider">
                                Image
                            </th>

                            <th class="px-6 py-5 text-left text-sm uppercase tracking-wider">
                                Product Name
                            </th>

                            <th class="px-6 py-5 text-left text-sm uppercase tracking-wider">
                                Category
                            </th>

                            <th class="px-6 py-5 text-left text-sm uppercase tracking-wider">
                                Grade
                            </th>

                            <th class="px-6 py-5 text-left text-sm uppercase tracking-wider">
                                Stock
                            </th>

                            <th class="px-6 py-5 text-left text-sm uppercase tracking-wider">
                                Price
                            </th>

                            <th class="px-6 py-5 text-center text-sm uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <!-- TABLE BODY -->
                    <tbody class="bg-white">

                        @forelse($products as $product)

                        <tr class="border-b hover:bg-gray-50 transition duration-200">

                            <!-- IMAGE -->
                            <td class="px-6 py-5">

                                <img src="{{ asset('products/' . $product->image) }}"
                                     class="w-24 h-24 rounded-2xl object-cover shadow-lg border">

                            </td>

                            <!-- PRODUCT NAME -->
                            <td class="px-6 py-5">

                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $product->name }}
                                </h3>

                            </td>

                            <!-- CATEGORY -->
                            <td class="px-6 py-5">

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">

                                    {{ $product->category }}

                                </span>

                            </td>

                            <!-- GRADE -->
                            <td class="px-6 py-5">

                                @if($product->grade == 'A')

                                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Grade A
                                    </span>

                                @else

                                    <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Grade B
                                    </span>

                                @endif

                            </td>

                            <!-- STOCK -->
                            <td class="px-6 py-5">

                                <div class="font-bold text-gray-700 text-lg">

                                    {{ $product->quantity }}
                                    {{ $product->unit }}

                                </div>

                                @if($product->quantity <= 5)

                                    <div class="text-red-500 text-sm font-semibold mt-1">
                                        ⚠ Low Stock
                                    </div>

                                @endif

                            </td>

                            <!-- PRICE -->
                            <td class="px-6 py-5">

                                <span class="text-2xl font-extrabold text-green-600">

                                    RM {{ number_format($product->price, 2) }}

                                </span>

                            </td>

                            <!-- ACTION BUTTONS -->
                            <td class="px-6 py-5">

                                <div class="flex justify-center gap-3">

                                    <!-- EDIT -->
                                    <a href="{{ route('farmer-products.edit', $product->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl transition shadow">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('farmer-products.destroy', $product->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Delete this product?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl transition shadow">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <!-- EMPTY STATE -->
                        <tr>

                            <td colspan="7" class="text-center py-24">

                                <div class="flex flex-col items-center">

                                    <div class="text-8xl mb-6">
                                        🌾
                                    </div>

                                    <h2 class="text-4xl font-extrabold text-gray-700 mb-4">
                                        No Products Yet
                                    </h2>

                                    <p class="text-gray-500 text-lg mb-8">
                                        Start adding your vegetables and fruits now.
                                    </p>

                                    <a href="{{ route('farmer-products.create') }}"
                                       class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl shadow-lg transition font-semibold text-lg">
                                        + Add Product
                                    </a>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>