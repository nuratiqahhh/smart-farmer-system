<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10">

@if(session('success'))

<div
class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif


@if(session('error'))

<div
class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

    {{ session('error') }}

</div>

@endif

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

    <!-- SEARCH -->
    <div class="bg-white rounded-xl shadow p-4 mb-4">

        <form method="GET" action="{{ route('admin.users') }}" class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name, email, phone or role..."
                class="flex-1 border rounded-lg px-4 py-3">

            <button
                type="submit"
                class="bg-green-600 text-white px-6 py-3 rounded-lg">

                🔍 Search

            </button>

            @if(request('search'))

                <a href="{{ route('admin.users') }}"
                class="bg-gray-300 px-6 py-3 rounded-lg">

                    Clear

                </a>

            @endif

        </form>

    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-600 text-white">

                <tr>

                    <th class="p-4 text-left">Name</th>

                    <th class="p-4 text-left">Email</th>

                    <th class="p-4 text-left">Phone</th>

                    <th class="p-4 text-left">Role</th>

                    <th class="p-4 text-left">Joined Date</th>

                    <th class="p-4 text-left">Action</th>

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

                        <td class="p-4">

                            {{ $user->created_at->format('d M Y') }}

                        </td>

                        <td class="p-4">

                        @if($user->id != auth()->id())

                        <form
                            action="{{ route('admin.users.delete', $user->id) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this user?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">

                                Delete

                            </button>

                        </form>

                        @else

                        <span
                            class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full">

                            Protected

                        </span>

                        @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="p-6 text-center text-gray-500">

                            No users found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <!-- PAGINATION -->
        <div class="p-4 border-t">
            {{ $users->links() }}
        </div>

    </div>

</div>

</body>
</html>