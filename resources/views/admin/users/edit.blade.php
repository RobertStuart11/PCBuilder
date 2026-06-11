<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
        <span class="font-bold text-white">Admin</span>
    </a>
    <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Kembali</a>
</nav>

<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white rounded-xl shadow p-8 space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" value="{{ $user->email }}" disabled
                   class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-gray-600">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="buyer" {{ $user->role === 'buyer' ? 'selected' : '' }}>Buyer</option>
                <option value="seller" {{ $user->role === 'seller' ? 'selected' : '' }}>Seller</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                Update User
            </button>
            <a href="{{ route('admin.users.index') }}" class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 rounded-lg text-center font-semibold transition">
                Batal
            </a>
        </div>
    </form>
</div>

</body>
</html>