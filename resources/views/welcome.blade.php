<!DOCTYPE html>
<html>
<head>
    <title>Smart Local Farmer Inventory & Sales System</title>

    @vite('resources/css/app.css')
</head>

<body class="relative h-screen flex items-center justify-center overflow-hidden text-white">

    <!-- 🌄 Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/farm.png') }}" 
             class="w-full h-full object-cover scale-110">

        <!-- 🔥 Strong Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/80"></div>
    </div>

    <!-- 💎 Glass Card -->
    <div class="relative z-10 bg-white/10 backdrop-blur-md p-10 rounded-2xl 
                shadow-[0_20px_60px_rgba(0,0,0,0.5)] text-center max-w-xl">

        <!-- Title -->
        <h1 class="text-4xl font-bold leading-tight mb-4 tracking-wide">
            Smart Local Farmer <br>
            Inventory & Sales System
        </h1>

        <!-- Subtitle -->
        <p class="text-gray-200 mb-6">
            Manage local farming inventory, products, and sales efficiently.
        </p>

        <!-- Buttons -->
        <div class="flex justify-center gap-4">

            <!-- Login -->
            <a href="{{ route('login') }}" 
               class="bg-white text-black px-6 py-2 rounded-lg font-semibold 
                      hover:bg-gray-200 hover:scale-105 transform transition">
                Login
            </a>

            <!-- Register -->
            <a href="{{ route('register') }}" 
               class="bg-green-600 px-6 py-2 rounded-lg font-semibold 
                      hover:bg-green-700 hover:scale-105 transform transition">
                Register
            </a>

        </div>

    </div>

</body>
</html>