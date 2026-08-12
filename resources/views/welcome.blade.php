<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Local Farmer</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-black text-white">

    <!-- Background -->
    <div class="fixed inset-0 -z-10">
        <img src="{{ asset('images/hero-farm.png') }}"
            class="w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Navbar -->
    <nav class="absolute top-0 left-0 w-full z-50">

        <div class="max-w-7xl mx-auto flex items-center justify-between px-10 py-6">

            <!-- Logo -->
            <h1 class="text-3xl font-bold tracking-wide">
                🌱 SmartFarmer
            </h1>

            <!-- Menu -->
            <div class="flex items-center gap-12">

                <a href="#" class="hover:text-green-400 transition">
                    Home
                </a>

                <a href="#features" class="hover:text-green-400 transition">
                    Features
                </a>

                <a href="#about" class="hover:text-green-400 transition">
                    About
                </a>

                <a href="{{ route('login') }}"
                    class="px-5 py-2 rounded-lg border-2 border-white hover:bg-white hover:text-black transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 transition">
                    Register
                </a>

            </div>

        </div>

    </nav>

    <!-- Hero Section -->
    <section class="h-[85vh] flex items-center">

        <div class="max-w-7xl mx-auto w-full px-10">

            <div class="max-w-2xl">

                <!-- Small Label -->
                <span class="inline-block bg-green-600/20 border border-green-500 text-green-300 px-4 py-2 rounded-full text-sm mb-6">
                    SMART FARM MANAGEMENT PLATFORM
                </span>

                <!-- Main Heading -->
                <h1 class="text-6xl font-extrabold leading-tight mb-6">
                    Smart Local Farmer
                    <span class="text-green-400">Inventory & Sales</span>
                    System
                </h1>

                <!-- Description -->
                <p class="text-gray-300 text-lg leading-8 mb-10">
                    Empowering local farmers with an integrated platform to manage inventory,
                    monitor harvest records, and sell fresh agricultural products directly
                    to customers.
                </p>

                <!-- Buttons -->
                <div class="flex gap-5">

                    <a href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 px-8 py-4 rounded-xl font-semibold transition duration-300 shadow-lg">
                        Get Started
                    </a>

                    <a href="{{ route('login') }}"
                        class="border border-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-black transition duration-300">
                        Login
                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- LIVE STATISTICS -->
    <section class="bg-white py-24">

        <div class="max-w-7xl mx-auto px-10">

            <div class="grid md:grid-cols-4 gap-8">

                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <h2 class="text-5xl font-bold text-green-600">
                        {{ $totalProducts }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        Products
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <h2 class="text-5xl font-bold text-green-600">
                        {{ $totalFarmers }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        Farmers
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <h2 class="text-5xl font-bold text-green-600">
                        {{ $totalOrders }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        Orders
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <h2 class="text-5xl font-bold text-green-600">
                        RM {{ number_format($totalRevenue,2) }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        Total Revenue
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="bg-gray-50 py-24">

        <div class="max-w-7xl mx-auto px-10">

            <div class="text-center mb-16">

                <span class="text-green-600 font-semibold uppercase tracking-widest">
                    Marketplace
                </span>

                <h2 class="text-5xl font-bold mt-4 text-gray-800">
                    Fresh From Our Farmers
                </h2>

                <p class="mt-4 text-gray-500">
                    Browse some of the latest products uploaded by local farmers.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($featuredProducts as $product)

                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300">

                    <img src="{{ asset('products/'.$product->image) }}"
                        class="h-60 w-full object-cover">

                    <div class="p-6">

                        <span class="inline-block bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full mb-3">
                            Grade {{ $product->grade }}
                        </span>

                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-500 mt-2">
                            {{ $product->category }}
                        </p>

                        <div class="flex justify-between items-center mt-6">

                            <div>

                                <p class="text-3xl font-bold text-green-600">
                                    RM {{ number_format($product->price,2) }}
                                </p>

                                <small class="text-gray-500">
                                    per {{ $product->unit }}
                                </small>

                            </div>

                            <a href="{{ route('shop') }}"
                            class="bg-green-600 text-white px-5 py-3 rounded-xl hover:bg-green-700 transition">

                                View

                            </a>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    <!-- MEET OUR FARMERS -->
    <section class="py-24 bg-white">

        <div class="max-w-7xl mx-auto px-8">

            <div class="text-center mb-14">

                <span class="text-green-600 uppercase tracking-widest font-semibold">
                    Our Farmers
                </span>

                <h2 class="text-5xl font-bold mt-3 text-gray-900">
                    Meet Our Farmers
                </h2>

                <p class="text-gray-500 mt-4">
                    Local farmers who provide fresh agricultural products through our platform.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach($farmers as $farmer)

                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:-translate-y-2 transition duration-300">

                    <div class="w-20 h-20 rounded-full bg-green-100 mx-auto flex items-center justify-center text-3xl font-bold text-green-700">
                        {{ strtoupper(substr($farmer->name,0,1)) }}
                    </div>

                    <h3 class="text-xl font-bold mt-5 text-gray-800">
                        {{ $farmer->name }}
                    </h3>

                    <p class="text-gray-500 mt-2">
                        {{ $farmer->products_count }} Products
                    </p>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    <!-- FEATURES -->
    <section id="features" class="bg-white py-24 text-gray-800">

        <div class="max-w-7xl mx-auto px-8">

            <div class="text-center mb-16">

                <span class="text-green-600 font-semibold uppercase tracking-widest">
                    Features
                </span>

                <h2 class="text-5xl font-bold mt-4">
                    Everything Farmers Need
                </h2>

                <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                    SmartFarmer simplifies inventory management, harvest tracking,
                    product selling and order monitoring in one platform.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-gray-50 rounded-2xl p-8 shadow hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <h3 class="text-xl font-bold mb-3">
                        Inventory Management
                    </h3>

                    <p class="text-gray-600">
                        Easily manage available stock and product quantities.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 shadow hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <h3 class="text-xl font-bold mb-3">
                        Harvest Records
                    </h3>

                    <p class="text-gray-600">
                        Record harvest information and monitor production history.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 shadow hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <h3 class="text-xl font-bold mb-3">
                        Marketplace
                    </h3>

                    <p class="text-gray-600">
                        Farmers can sell products directly to buyers through the platform.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8 shadow hover:shadow-xl hover:-translate-y-2 transition duration-300">
                    <h3 class="text-xl font-bold mb-3">
                        Sales Reports
                    </h3>

                    <p class="text-gray-600">
                        View sales performance and transaction reports instantly.
                    </p>
                </div>

            </div>

        </div>

    </section>

</body>

</html>