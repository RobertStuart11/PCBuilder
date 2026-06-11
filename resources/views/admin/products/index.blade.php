<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-12">
        </a>
        <div class="flex items-center gap-6 text-sm text-slate-300">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-400 transition">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="text-sky-400 font-semibold">Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="hover:text-sky-400 transition">Orders</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
                Kelola Produk
            </h1>
            <p class="text-slate-400 text-lg mt-2">Total: {{ $components->total() }} produk</p>
        </div>
        <a href="{{ route('admin.components.create') }}" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-bold transition shadow-lg">
            + Tambah Produk
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Products Table -->
    <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-800/80 border-b border-slate-700">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Produk</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Brand</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Kategori</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Harga</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Stok</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($components as $component)
                <tr class="border-b border-slate-800/50 hover:bg-slate-800/30 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($component->image)
                                <img src="{{ $component->image_url }}" alt="{{ $component->name }}" class="w-10 h-10 rounded-lg object-cover border border-slate-700">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center text-xs text-slate-500">No Image</div>
                            @endif
                            <div>
                                <p class="font-semibold text-slate-100">{{ $component->name }}</p>
                                <p class="text-xs text-slate-500">ID: {{ $component->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-slate-300">
                        {{ $component->brand }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-sky-500/20 text-sky-400 border border-sky-500/50">
                            {{ $component->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-green-400">Rp {{ number_format($component->price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-semibold {{ $component->stock < 5 ? 'text-red-400' : ($component->stock < 20 ? 'text-yellow-400' : 'text-green-400') }}">
                            {{ $component->stock }} unit
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $component) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-sky-500/20 hover:bg-sky-500/30 text-sky-400 rounded-lg transition font-semibold text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.products.destroy', $component) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-lg transition font-semibold text-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-slate-400">Belum ada produk. <a href="{{ route('admin.components.create') }}" class="text-sky-400 hover:text-sky-300 font-semibold">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($components->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="flex gap-2">
                {{-- Previous Page Link --}}
                @if ($components->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-slate-800/50 border border-slate-700 cursor-not-allowed rounded-lg">← Sebelumnya</span>
                @else
                    <a href="{{ $components->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-sky-400 bg-slate-800/50 hover:bg-slate-800 border border-slate-700 rounded-lg transition">← Sebelumnya</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($components->getUrlRange(1, $components->lastPage()) as $page => $url)
                    @if ($page == $components->currentPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-sky-500 to-blue-600 border border-sky-500 rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-300 bg-slate-800/50 hover:bg-slate-800 border border-slate-700 rounded-lg transition">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($components->hasMorePages())
                    <a href="{{ $components->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-sky-400 bg-slate-800/50 hover:bg-slate-800 border border-slate-700 rounded-lg transition">Selanjutnya →</a>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-500 bg-slate-800/50 border border-slate-700 cursor-not-allowed rounded-lg">Selanjutnya →</span>
                @endif
            </div>
        </div>
    @endif

</div>

</body>
</html>
