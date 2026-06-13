<!DOCTYPE html>
<html>
<head>
    <title>Harvest Records</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-green-900 text-white p-6 fixed top-0 left-0 h-screen shadow-2xl z-50 overflow-y-auto">

        <div class="mb-10">
            <h1 class="text-3xl font-extrabold leading-tight">
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
                class="block bg-green-700 px-4 py-3 rounded-2xl">
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
                <a href="{{ url('/farmer/profile') }}"
                class="block hover:bg-green-700 px-4 py-3 rounded-2xl">
                    Profile
                </a>
            </li>

            <li class="pt-8">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        class="w-full text-left bg-red-500 hover:bg-red-600 px-4 py-3 rounded-2xl transition font-semibold shadow">

                        Logout

                    </button>

                </form>

            </li>

        </ul>

    </div>

    <div class="flex-1 ml-64 p-10">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-4xl font-bold">
            Harvest Records
        </h1>

        <div class="flex gap-3">

            <a href="{{ route('farmer.dashboard') }}"
            class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">

                ← Dashboard

            </a>

            <a href="{{ route('harvest-records.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

                + Add Record

            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>

    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-600 text-white">

                <tr>
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3 text-left">Grade</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Harvest Date</th>
                    <th class="p-3 text-left">Notes</th>
                </tr>

            </thead>

            <tbody>

                @forelse($records as $record)

                    <tr class="border-b">

                        <td class="p-3">
                            {{ $record->product->name }}
                        </td>

                        <td class="p-3">

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                {{ $record->product->grade }}

                            </span>

                        </td>

                        <td class="p-3">
                            {{ $record->harvest_quantity }}
                        </td>

                        <td class="p-3">
                            {{ $record->harvest_date }}
                        </td>

                        <td class="p-3">
                            {{ $record->notes }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="p-5 text-center text-gray-500">

                            No harvest records found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

    </div>

</div>

</body>
</html>