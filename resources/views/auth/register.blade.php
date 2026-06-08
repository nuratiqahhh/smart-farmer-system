<!DOCTYPE html>
<html>
<head>
    <title>Register - Smart Local Farmer System</title>
    @vite('resources/css/app.css')
</head>

<body class="relative h-screen flex items-center justify-center text-white overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/farm.png') }}"
             class="w-full h-full object-cover scale-105">

        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <!-- Register Card -->
    <div class="relative bg-white/20 backdrop-blur-lg p-10 rounded-2xl shadow-2xl w-[420px]">

        <!-- Title -->
        <h2 class="text-4xl font-bold text-center mb-8">
            Create Account
        </h2>

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">

                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}">

            @csrf

            <!-- Name -->
            <input type="text"
                   name="name"
                   placeholder="Full Name"
                   class="w-full mb-4 p-3 rounded text-black">

            <!-- Email -->
            <input type="email"
                   name="email"
                   placeholder="Email"
                   class="w-full mb-4 p-3 rounded text-black">

            <!-- Phone -->
            <input type="text"
                   name="phone"
                   placeholder="Phone Number"
                   class="w-full mb-4 p-3 rounded text-black">

            <!-- Password -->
            <input type="password"
                   name="password"
                   placeholder="Password"
                   class="w-full mb-4 p-3 rounded text-black">

            <!-- Confirm Password -->
            <input type="password"
                   name="password_confirmation"
                   placeholder="Confirm Password"
                   class="w-full mb-6 p-3 rounded text-black">

            <!-- ROLE -->
            <label class="block mb-2 font-semibold">
                Register As
            </label>

            <select name="role"
                    class="w-full mb-6 p-3 rounded text-black">

                <option value="buyer">Buyer</option>
                <option value="farmer">Farmer</option>

            </select>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 py-3 rounded-lg font-bold">

                Register

            </button>

        </form>

        <!-- Login -->
        <p class="text-center mt-6">

            Already have an account?

            <a href="{{ route('login') }}"
               class="underline font-semibold">

                Login

            </a>

        </p>

    </div>

</body>
</html>