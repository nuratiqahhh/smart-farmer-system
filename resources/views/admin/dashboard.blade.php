<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    @vite('resources/css/app.css')

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-green-800 text-white p-6">
        <h2 class="text-2xl font-bold mb-8">🌾 Farmer System</h2>

        <ul class="space-y-4">
            <li><a href="{{ route('admin.dashboard') }}" class="block hover:bg-green-700 p-2 rounded">Dashboard</a></li>
            <li><a href="{{ route('admin.products') }}" class="block hover:bg-green-700 p-2 rounded">Products</a></li>
            <li><a href="{{ route('orders.index') }}" class="block hover:bg-green-700 p-2 rounded">Orders</a></li>
            <li><a href="#" class="block hover:bg-green-700 p-2 rounded">Users</a></li>

            <li class="mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left hover:bg-red-600 p-2 rounded">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main -->
    <div class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
            <span>Welcome, {{ auth()->user()->name }}</span>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Products</h3>
                <p class="text-2xl text-green-700 font-bold">
                    {{ \App\Models\Product::count() }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Orders</h3>
                <p class="text-2xl text-blue-600 font-bold">
                    {{ \App\Models\Order::count() }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Users</h3>
                <p class="text-2xl text-purple-600 font-bold">
                    {{ \App\Models\User::count() }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3>Total Sales (RM)</h3>
                <p class="text-2xl text-red-600 font-bold">
                    {{ \App\Models\Order::sum('total_price') }}
                </p>
            </div>

        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <!-- BAR CHART -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-4">Sales Chart</h2>
                <div class="h-64">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- PIE CHART -->
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <h2 class="text-lg font-semibold mb-4">Product Distribution</h2>
                <div class="h-64 max-w-xs mx-auto">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Latest Orders -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-4">Latest Orders</h2>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="p-2">Product</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(\App\Models\Order::latest()->take(5)->get() as $order)
                    <tr class="border-b">
                        <td class="p-2">{{ $order->product->name ?? '-' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td class="text-green-600 font-bold">RM {{ $order->total_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Chart Script -->
<script>
    // BAR CHART
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach(\App\Models\Order::all() as $order)
                    "{{ $order->product->name }}",
                @endforeach
            ],
            datasets: [{
                label: 'Sales (RM)',
                data: [
                    @foreach(\App\Models\Order::all() as $order)
                        {{ $order->total_price }},
                    @endforeach
                ],
                backgroundColor: [
                    '#3b82f6', // blue
                    '#6366f1', // indigo
                    '#f59e0b', // amber
                    '#ef4444', // red
                    '#8b5cf6'  // purple
                ],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // PIE CHART
    const pieCtx = document.getElementById('pieChart').getContext('2d');

    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: [
                @foreach(\App\Models\Product::all() as $product)
                    "{{ $product->name }}",
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach(\App\Models\Product::all() as $product)
                        {{ $product->quantity }},
                    @endforeach
                ],
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

</body>
</html>