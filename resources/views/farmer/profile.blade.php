<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmer Profile</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 to-green-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-900 text-white p-6 fixed h-full shadow-2xl">

        <h1 class="text-4xl font-extrabold mb-10 leading-tight">
            🌾 Farmer Panel
        </h1>

        <ul class="space-y-3">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-xl transition">
                    Dashboard
                </a>
            </li>

            <!-- Products -->
            <li>
                <a href="{{ route('farmer-products.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-xl transition">
                    My Products
                </a>
            </li>

            <li>
                <a href="{{ route('harvest-records.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    Harvest Records
                </a>
            </li>

            <li>
                <a href="{{ route('reports.index') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl transition">
                    Reports
                </a>
            </li>

            <!-- Orders -->
            <li>
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-xl transition">
                    Customer Orders
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="/farmer/profile"
                   class="block bg-green-700 px-4 py-3 rounded-xl font-medium">
                    Profile
                </a>
            </li>

            <!-- Logout -->
            <li class="pt-10">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold">
                        Logout
                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 ml-64 p-10">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-4xl font-bold text-gray-800">
                    Farmer Profile
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage your account information and security settings.
                </p>

            </div>

            <div class="bg-white px-5 py-3 rounded-xl shadow">

                <span class="text-gray-600">
                    {{ auth()->user()->name }}
                </span>

            </div>

        </div>

        <!-- PROFILE CARD -->
        <div class="bg-gradient-to-r from-green-700 to-green-500 rounded-3xl p-8 text-white shadow-xl mb-10 hover:scale-[1.01] transition duration-300">

            <div class="flex items-center gap-6">

                <!-- AVATAR -->
                <div class="w-32 h-32 rounded-full bg-white text-green-700 flex items-center justify-center text-5xl font-bold shadow-lg">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

                <!-- INFO -->
                <div>

                    <h2 class="text-5xl font-bold mb-2">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-green-100 text-lg">
                        {{ auth()->user()->email }}
                    </p>

                    <span class="inline-block mt-4 bg-white text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                        Farmer Account
                    </span>

                </div>

            </div>

        </div>

        <!-- PROFILE FORM -->
        <div class="bg-white p-8 rounded-3xl shadow-lg mb-10">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                👤 Profile Information
            </h2>

            <form method="POST" action="{{ route('profile.update') }}">

                @csrf
                @method('PATCH')

                <!-- NAME -->
                <div class="mb-6">

                    <label class="block text-gray-700 font-semibold mb-2">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ auth()->user()->name }}"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- EMAIL -->
                <div class="mb-6">

                    <label class="block text-gray-700 font-semibold mb-2">
                        Email Address
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ auth()->user()->email }}"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- BUTTON -->
                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold transition">

                    Save Changes

                </button>

            </form>

        </div>

        <!-- PASSWORD FORM -->
        <div class="bg-white p-8 rounded-3xl shadow-lg mb-10">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                🔒 Change Password
            </h2>

            <form method="POST" action="{{ route('password.update') }}">

                @csrf
                @method('PUT')

                <!-- CURRENT PASSWORD -->
                <div class="mb-6">

                    <label class="block text-gray-700 font-semibold mb-2">
                        Current Password
                    </label>

                    <input type="password"
                           name="current_password"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- NEW PASSWORD -->
                <div class="mb-6">

                    <label class="block text-gray-700 font-semibold mb-2">
                        New Password
                    </label>

                    <input type="password"
                           name="password"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="mb-6">

                    <label class="block text-gray-700 font-semibold mb-2">
                        Confirm Password
                    </label>

                    <input type="password"
                           name="password_confirmation"
                           class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none">

                </div>

                <!-- BUTTON -->
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold transition">

                    Update Password

                </button>

            </form>

        </div>

        <!-- DELETE ACCOUNT -->
        <div class="bg-white p-8 rounded-3xl shadow-lg border border-red-200">

            <h2 class="text-2xl font-bold text-red-500 mb-4">
                ⚠ Danger Zone
            </h2>

            <p class="text-gray-600 mb-6">
                Once you delete your account, all data will be permanently removed.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">

                @csrf
                @method('DELETE')

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-8 py-4 rounded-xl font-semibold transition">

                    Delete Account

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>