<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow text-center">

    <h1 class="text-4xl font-bold text-green-600 mb-4">
        Payment Successful
    </h1>

    <p class="text-gray-500 mb-8">
        Thank you for your purchase.
    </p>

    <div class="text-left space-y-4">

        <div>
            <strong>Buyer:</strong>
            {{ $checkout->fullname }}
        </div>

        <div>
            <strong>Phone:</strong>
            {{ $checkout->phone }}
        </div>

        <div>
            <strong>Payment:</strong>
            {{ $checkout->payment_method }}
        </div>

        <div>
            <strong>Total Paid:</strong>
            RM {{ $checkout->total_price }}
        </div>

        <div>
            <strong>Status:</strong>
            {{ $checkout->status }}
        </div>

    </div>

    <a href="/shop"
       class="inline-block mt-8 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">

        Continue Shopping

    </a>

</div>

</body>
</html>