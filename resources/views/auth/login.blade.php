<!DOCTYPE html>
<html>
<head>
    <title>Login - Smart Local Farmer System</title>
    @vite('resources/css/app.css')
</head>

<body class="relative h-screen flex items-center justify-center text-white overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/farm.jpg') }}" 
             class="w-full h-full object-cover scale-105">

        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <!-- Login Card -->
    <div class="relative bg-white/20 backdrop-blur-lg p-10 rounded-2xl shadow-2xl w-[400px]
                animate-[fadeIn_1s_ease-out]">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center mb-6 drop-shadow-lg">
            Login
        </h2>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <input type="email" name="email" placeholder="Email"
                class="w-full mb-4 p-2 rounded bg-white/80 text-black outline-none">

            <!-- Password -->
            <input type="password" name="password" placeholder="Password"
                class="w-full mb-6 p-2 rounded bg-white/80 text-black outline-none">

            <!-- Button -->
            <button type="submit"
                class="w-full bg-white text-green-700 py-2 rounded-lg font-semibold shadow
                       hover:scale-105 hover:bg-gray-100 transition duration-300">
                Login
            </button>

        </form>

        <!-- Register Link -->
        <p class="text-center mt-4 text-sm text-white/80">
            Don't have an account?
            <a href="{{ route('register') }}" class="underline hover:text-white">
                Register
            </a>
        </p>

    </div>

    <!-- Animation -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>

</body>
</html>