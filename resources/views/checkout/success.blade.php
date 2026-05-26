<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded-2xl shadow-xl text-center w-full max-w-lg">

        <!-- Success Icon -->
        <div class="text-7xl mb-5">
            ✅
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-green-600 mb-4">
            Payment Successful!
        </h1>

        <!-- Message -->
        <p class="text-gray-600 text-lg mb-8">
            Your order has been placed successfully.
        </p>

        <!-- Buttons -->
        <div class="flex gap-4 justify-center">

            <!-- Shop -->
            <a href="/shop"
               class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition">

                Continue Shopping

            </a>

            <!-- Orders -->
            <a href="/my-orders"
               class="bg-gray-300 text-black px-6 py-3 rounded-xl hover:bg-gray-400 transition">

                View Orders

            </a>

        </div>

    </div>

</body>
</html>