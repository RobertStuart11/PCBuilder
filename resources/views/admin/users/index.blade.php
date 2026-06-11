<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
        <span class="font-bold text-white">Admin</span>
    </a>
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 hover:text-red-700 text-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="max-w-6xl mx-auto px-4 py-8">

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">
            [OK] {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-800 mb-6">👥 Manajemen User</h1>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Total User</p>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Buyer</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['buyers'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Seller</p>
            <p class="text-2xl font-bold text-purple-600">{{ $stats['sellers'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 text-center">
            <p class="text-gray-500 text-sm">Admin</p>
            <p class="text-2xl font-bold text-red-600">{{ $stats['admins'] }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Nama</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Email</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Role</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Joined</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-6 py-3 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-3">
                        <span class="text-xs px-2 py-1 rounded-full font-medium
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'seller' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="text-yellow-500 hover:text-yellow-700 text-xs font-medium">Edit</a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')"
                                        class="text-red-500 hover:text-red-700 text-xs font-medium">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-400">Tidak ada user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

</body>
</html>