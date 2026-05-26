<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    @vite('resources/css/app.css')
</head>
<body class="p-10 bg-gray-100">

<h1 class="text-2xl font-bold mb-4">Edit Product</h1>

<form method="POST" action="{{ route('products.update', $product->id) }}" class="bg-white p-6 rounded shadow w-96">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}" class="border p-2 w-full mb-3">
    <input type="text" name="category" value="{{ $product->category }}" class="border p-2 w-full mb-3">
    <input type="number" name="quantity" value="{{ $product->quantity }}" class="border p-2 w-full mb-3">
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="border p-2 w-full mb-3">

    <button class="bg-blue-600 text-white px-4 py-2 w-full">Update</button>
</form>

</body>
</html>