<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-4xl font-bold text-gray-800">
                Manage Users
            </h1>

            <p class="text-gray-500">
                View all registered users.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">

            ← Back

        </a>

    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-600 text-white">

                <tr>

                    <th class="p-4 text-left">Name</th>

                    <th class="p-4 text-left">Email</th>

                    <th class="p-4 text-left">Phone</th>

                    <th class="p-4 text-left">Role</th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr class="border-b">

                        <td class="p-4">
                            {{ $user->name }}
                        </td>

                        <td class="p-4">
                            {{ $user->email }}
                        </td>

                        <td class="p-4">
                            {{ $user->phone ?? '-' }}
                        </td>

                        <td class="p-4">

                            @if($user->role == 'admin')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                    Admin
                                </span>

                            @elseif($user->role == 'farmer')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    Farmer
                                </span>

                            @else

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                    Buyer
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="p-6 text-center text-gray-500">

                            No users found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>