<!DOCTYPE html>
<html>
<head>
    <title>Create Order</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Create Order</h1>

    <form method="POST" action="{{ route('orders.store') }}" 
          class="bg-white p-6 rounded shadow w-[400px]">
        @csrf

        <!-- Product -->
        <label class="block mb-2">Select Product</label>
        <select name="product_id" class="w-full mb-4 p-2 border rounded">
            @foreach($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (RM {{ $product->price }})
                </option>
            @endforeach
        </select>

        <!-- Quantity -->
        <label class="block mb-2">Quantity</label>
        <input type="number" name="quantity" 
               class="w-full mb-4 p-2 border rounded" required>

        <!-- Button -->
        <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded w-full">
            Place Order
        </button>

    </form>

</body>
</html>