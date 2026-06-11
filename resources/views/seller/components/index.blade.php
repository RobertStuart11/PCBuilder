<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Produk Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('seller.dashboard') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
    </a>
    <div class="flex items-center gap-4">
        <a href="{{ route('seller.dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">Dashboard</a>
        <a href="{{ route('seller.components.index') }}" class="text-blue-600 font-semibold text-sm">Produk Saya</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 hover:text-red-700 text-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="max-w-6xl mx-auto mt-8 px-4">

    {{-- Alert --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">
            [OK] {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Produk Saya</h1>
        <a href="{{ route('seller.components.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition">
            + Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Produk</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Kategori</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Harga</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Stok</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Status</th>
                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($components as $component)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($component->image)
                                <img src="{{ $component->image_url }}"
                                     class="w-10 h-10 rounded-lg object-cover bg-gray-100">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-xl">BOX</div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-800">{{ $component->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $component->brand }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ $component->category }}</span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $component->price_formatted }}</td>
                    <td class="px-6 py-4">
                        <span class="{{ $component->stock < 5 ? 'text-red-500' : 'text-gray-700' }} font-medium">
                            {{ $component->stock }} unit
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($component->is_active)
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Aktif</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('seller.components.edit', $component) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded-lg">Edit</a>
                            <form method="POST" action="{{ route('seller.components.destroy', $component) }}"
                                  onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-lg">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-16 text-gray-400">
                        <p class="text-4xl mb-3">BOX</p>
                        <p>Belum ada produk. <a href="{{ route('seller.components.create') }}" class="text-blue-500 hover:underline">Tambah sekarang!</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($components->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $components->links() }}
        </div>
        @endif
    </div>
</div>

</body>
</html>