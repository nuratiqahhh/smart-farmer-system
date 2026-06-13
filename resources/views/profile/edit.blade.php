<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-900 text-white p-6 fixed top-0 left-0 h-screen shadow-2xl z-50 overflow-y-auto">

        <div class="mb-10">
            <h1 class="text-3xl font-extrabold">
                🌾 Farmer Panel
            </h1>
        </div>

        <ul class="space-y-4">

            <li>
                <a href="{{ route('farmer.dashboard') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('farmer-products.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    My Products
                </a>
            </li>

            <li>
                <a href="{{ route('harvest-records.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Harvest Records
                </a>
            </li>

            <li>
                <a href="{{ route('reports.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Reports
                </a>
            </li>

            <li>
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Customer Orders
                </a>
            </li>

            <li>
                <a href="{{ route('profile.edit') }}"
                   class="block bg-green-700 px-4 py-3 rounded-2xl">
                    Profile
                </a>
            </li>

            <li class="pt-8">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold shadow">

                        Logout

                    </button>

                </form>

            </li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 ml-64 p-10">

        <h1 class="text-5xl font-extrabold text-gray-800 mb-2">
            My Profile
        </h1>

        <p class="text-gray-500 text-lg mb-8">
            Manage your account information and security settings.
        </p>

        <div class="space-y-8">

            <div class="bg-white rounded-3xl shadow-2xl p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white rounded-3xl shadow-2xl p-8">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-red-50 border border-red-200 rounded-3xl shadow-xl p-8">
                @include('profile.partials.delete-user-form')
            </div>

        </div>

    </div>

</div>

</body>
</html>