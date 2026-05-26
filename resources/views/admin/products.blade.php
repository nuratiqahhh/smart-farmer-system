<!DOCTYPE html>
<html>
<head>
    <title>All Products (Admin)</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-2xl font-bold mb-6">All Products (Admin)</h1>

<div class="bg-white p-6 rounded shadow">

@foreach($products as $product)
    <div class="border-b py-3 flex justify-between items-center">

        <div>
            <p class="font-semibold">{{ $product->name }}</p>
            <p class="text-sm text-gray-500">
                {{ $product->category }} | Qty: {{ $product->quantity }}
            </p>
            <p class="text-xs text-gray-400">
                Owner: {{ $product->user->name }}
            </p>
        </div>

        <div class="flex items-center gap-3">

            <span class="text-green-600 font-bold">
                RM {{ $product->price }}
            </span>

            <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                @csrf
                @method('DELETE')

                <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                    Delete
                </button>
            </form>

        </div>

    </div>
@endforeach

</div>

</body>
</html>