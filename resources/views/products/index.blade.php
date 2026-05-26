<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Products</title>
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

            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block hover:bg-green-700 p-3 rounded-lg">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}"
                   class="block bg-green-700 p-3 rounded-lg">
                    My Products
                </a>
            </li>

            <li>
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-green-700 p-3 rounded-lg">
                    Customer Orders
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}"
                   class="block hover:bg-green-700 p-3 rounded-lg">
                    Profile
                </a>
            </li>

            <li class="pt-10">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left hover:bg-red-600 p-3 rounded-lg">
                        Logout
                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-start mb-8">

            <div>

                <h1 class="text-4xl font-bold text-gray-800">
                    My Products
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage all your farm products here.
                </p>

            </div>

            <a href="{{ route('products.create') }}"
               class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                + Add Product
            </a>

        </div>

        <!-- Success -->
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>

        @endif

        <!-- Product List -->
        @if($products->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach($products as $product)

                    <div class="bg-white rounded-2xl shadow overflow-hidden">

                        <!-- Image -->
                        <img src="{{ asset('products/' . $product->image) }}"
                             class="w-full h-56 object-cover">

                        <!-- Content -->
                        <div class="p-5">

                            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                {{ $product->name }}
                            </h2>

                            <p class="text-gray-500 mb-2">
                                Category:
                                {{ $product->category }}
                            </p>

                            <p class="text-gray-500 mb-2">
                                Stock:
                                {{ $product->quantity }}
                                {{ $product->unit }}
                            </p>

                            <p class="text-green-600 font-bold text-xl mb-4">
                                RM {{ number_format($product->price, 2) }}
                            </p>

                            <!-- Delete -->
                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600">
                                    Delete Product
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white p-10 rounded-2xl shadow text-center">

                <h2 class="text-3xl font-bold text-gray-700 mb-4">
                    No Products Yet
                </h2>

                <p class="text-gray-500 mb-6">
                    Start adding your farm products to begin selling.
                </p>

                <a href="{{ route('products.create') }}"
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    + Add First Product
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>