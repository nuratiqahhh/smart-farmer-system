<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-800 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">
            👨‍💼 Admin Panel
        </h2>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products') }}"
                   class="block bg-green-700 p-2 rounded">
                    Products
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Orders
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users') }}"
                   class="block hover:bg-green-700 p-2 rounded">
                    Users
                </a>
            </li>

            <li class="mt-10">
                <form method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left hover:bg-red-600 p-2 rounded">
                        Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-8">

        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-3xl font-bold">
                    Product Management
                </h1>

                <p class="text-gray-500">
                    View and monitor all products uploaded by farmers.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                ← Back
            </a>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-green-600 text-white">

                    <tr>

                        <th class="p-4 text-left">Image</th>

                        <th class="p-4 text-left">Product</th>

                        <th class="p-4 text-left">Category</th>

                        <th class="p-4 text-left">Grade</th>

                        <th class="p-4 text-left">Stock</th>

                        <th class="p-4 text-left">Price</th>

                        <th class="p-4 text-left">Farmer</th>

                        <th class="p-4 text-left">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr class="border-b hover:bg-gray-50">

                        <!-- IMAGE -->
                        <td class="p-4">

                            <img
                                src="{{ asset('products/'.$product->image) }}"
                                class="w-16 h-16 object-cover rounded">

                        </td>

                        <!-- NAME -->
                        <td class="p-4 font-semibold">

                            {{ $product->name }}

                        </td>

                        <!-- CATEGORY -->
                        <td class="p-4">

                            {{ $product->category }}

                        </td>

                        <!-- GRADE -->
                        <td class="p-4">

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                {{ $product->grade }}
                            </span>

                        </td>

                        <!-- STOCK -->
                        <td class="p-4 font-bold">

                            {{ $product->quantity }}

                        </td>

                        <!-- PRICE -->
                        <td class="p-4 text-green-600 font-bold">

                            RM {{ number_format($product->price,2) }}

                        </td>

                        <!-- FARMER -->
                        <td class="p-4">

                            {{ $product->user->name ?? '-' }}

                        </td>

                        <!-- DELETE -->
                        <td class="p-4">

                            <form method="POST"
                                  action="{{ route('farmer-products.destroy',$product->id) }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this product?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="p-6 text-center text-gray-500">

                            No products found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>