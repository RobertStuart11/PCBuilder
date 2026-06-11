<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Katalog Komponen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pagination Styling */
        .pagination { display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem; }
        .pagination a, .pagination span { 
            px-3 py-2; 
            rounded-lg; 
            text-sm; 
            font-medium; 
            border: 1px solid rgba(100, 116, 139, 0.5);
            background-color: rgba(15, 23, 42, 0.5);
            color: rgb(226, 232, 240);
            transition: all 0.3s;
        }
        .pagination a:hover { 
            background-color: rgb(14, 165, 233);
            border-color: rgb(14, 165, 233);
            color: white;
        }
        .pagination span.active { 
            background-color: rgb(14, 165, 233);
            border-color: rgb(14, 165, 233);
            color: white;
        }
        .pagination span.disabled { 
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-12">
        </a>
        <div class="flex items-center gap-6 text-sm text-slate-300">
            <a href="{{ route('home') }}" class="hover:text-sky-400 transition">Home</a>
            @auth
                @if(auth()->user()->role === 'buyer')
                    <a href="{{ route('buyer.dashboard') }}" class="hover:text-sky-400 transition">Dashboard</a>
                @elseif(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="hover:text-sky-400 transition">Dashboard</a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-400 transition">Dashboard</a>
                @endif
                <a href="{{ route('cart.index') }}" class="relative hover:text-sky-400 transition font-medium flex items-center gap-2">
                    Keranjang
                    @php $cartCount = count(session('cart', [])) @endphp
                    @if($cartCount > 0)
                        <span class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $cartCount }}</span>
                    @endif
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-red-400 hover:text-red-300 transition">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-sky-400 transition">Login</a>
            @endauth
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
            Katalog Komponen PC
        </h1>
        <p class="text-slate-400 text-lg mt-2">{{ $components->total() }} produk tersedia untuk dibangun</p>
    </div>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('catalog.public') }}" 
          class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-2xl shadow-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <div class="md:col-span-2">
                <label class="text-xs text-slate-400 uppercase tracking-wide mb-2 block">Cari Produk</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Nama, brand, spesifikasi..."
                       class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 placeholder-slate-500 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
            </div>

            <div>
                <label class="text-xs text-slate-400 uppercase tracking-wide mb-2 block">Kategori</label>
                <select name="category" class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                    <option value="" class="bg-slate-900">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" class="bg-slate-900" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs text-slate-400 uppercase tracking-wide mb-2 block">Urutkan</label>
                <select name="sort" class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                    <option value="terbaru" class="bg-slate-900" {{ request('sort','terbaru') === 'terbaru'  ? 'selected' : '' }}>Terbaru</option>
                    <option value="termurah" class="bg-slate-900" {{ request('sort') === 'termurah' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="termahal" class="bg-slate-900" {{ request('sort') === 'termahal' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition shadow-lg">
                Cari
            </button>

            @if(request()->hasAny(['search','category','sort']))
            <a href="{{ route('catalog.public') }}"
               class="border border-slate-700 hover:bg-slate-800/50 text-slate-300 px-5 py-2.5 rounded-lg text-sm font-medium transition">
                Reset
            </a>
            @endif
        </div>
    </form>

    <!-- Category Chips -->
    <div class="flex gap-2 flex-wrap mb-8">
        @foreach($categories as $cat)
        <a href="{{ route('catalog.public') }}?category={{ $cat }}&sort={{ request('sort','terbaru') }}"
           class="px-4 py-2 rounded-full text-sm font-medium transition border-2 
           {{ request('category') === $cat
               ? 'bg-sky-600 border-sky-500 text-white shadow-lg shadow-sky-500/50'
               : 'bg-slate-900/50 border-slate-700 text-slate-300 hover:border-sky-400 hover:text-sky-300' }}">
            {{ $cat }}
        </a>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($components->isEmpty())
        <div class="text-center py-24 bg-gradient-to-br from-slate-900/50 to-slate-800/50 border border-slate-800 rounded-2xl">
            <p class="text-4xl mb-4 text-slate-600">!</p>
            <p class="text-slate-400 text-lg font-medium">Produk tidak ditemukan.</p>
            <p class="text-slate-500 text-sm mt-1">Coba ubah filter atau cari dengan keyword lain</p>
            <a href="{{ route('catalog.public') }}" class="text-sky-400 hover:text-sky-300 text-sm mt-4 inline-block font-medium transition">Lihat semua produk</a>
        </div>
    @else
    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($components as $component)
        <div class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-2xl shadow-lg hover:shadow-2xl hover:border-sky-500/50 transition-all duration-300 overflow-hidden">
            <!-- Image Container -->
            <div class="relative h-48 bg-gradient-to-br from-slate-800 to-slate-900 overflow-hidden flex items-center justify-center">
                <a href="{{ route('catalog.public.show', $component) }}" class="w-full h-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    @if($component->image)
                        <img src="{{ $component->image_url }}" alt="{{ $component->name }}" class="w-full h-full object-cover">
                    @else
                        @php
                            $colorMap = [
                                'CPU' => 'from-blue-600 to-blue-800',
                                'GPU' => 'from-green-600 to-green-800',
                                'RAM' => 'from-purple-600 to-purple-800',
                                'Motherboard' => 'from-orange-600 to-orange-800',
                                'PSU' => 'from-red-600 to-red-800',
                                'Storage' => 'from-violet-600 to-violet-800',
                                'Case' => 'from-cyan-600 to-cyan-800',
                                'Cooler' => 'from-pink-600 to-pink-800',
                            ];
                        @endphp
                        <div class="w-full h-full bg-gradient-to-br {{ $colorMap[$component->category] ?? 'from-slate-700 to-slate-900' }} flex items-center justify-center">
                            <span class="text-white text-center font-bold text-lg drop-shadow-lg">{{ $component->category }}</span>
                        </div>
                    @endif
                </a>
                <!-- Category Badge -->
                <span class="absolute top-3 left-3 text-xs font-bold px-3 py-1 rounded-full bg-sky-500/90 text-white backdrop-blur">
                    {{ $component->category }}
                </span>
                <!-- Stock Badge -->
                <span class="absolute top-3 right-3 text-xs font-bold px-3 py-1 rounded-full {{ $component->stock < 5 ? 'bg-red-500/90' : 'bg-green-500/90' }} text-white backdrop-blur">
                    {{ $component->stock < 5 ? 'Terbatas' : 'Ready' }}
                </span>
            </div>

            <!-- Content -->
            <div class="p-4">
                <a href="{{ route('catalog.public.show', $component) }}">
                    <h3 class="font-bold text-slate-100 text-sm leading-snug group-hover:text-sky-400 transition line-clamp-2 mb-1">
                        {{ $component->name }}
                    </h3>
                </a>
                <p class="text-xs text-slate-400 mb-3">{{ $component->brand }}</p>
                <!-- Price -->
                <div class="mb-4 pb-4 border-b border-slate-700">
                    <span class="text-lg font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
                        {{ $component->price_formatted }}
                    </span>
                    <p class="text-xs text-slate-500 mt-1">Stok: <span class="{{ $component->stock < 5 ? 'text-red-400 font-bold' : 'text-slate-400' }}">{{ $component->stock }}</span></p>
                </div>

                <!-- Specs/Description -->
                @if($component->description)
                <div class="mb-4 pb-4 border-b border-slate-700">
                    <p class="text-xs text-slate-300 line-clamp-2">{{ $component->description }}</p>
                </div>
                @endif

                <!-- Compatibility Info -->
                @php
                    $rules = $component->compatibilityAsFirst()->take(2)->get()
                        ->concat($component->compatibilityAsSecond()->take(2)->get());
                @endphp
                @if($rules->isNotEmpty())
                <div class="mb-4 pb-4 border-b border-slate-700">
                    <p class="text-xs font-semibold text-slate-300 mb-2">Kompatibilitas:</p>
                    @foreach($rules->take(1) as $rule)
                        @php
                            $other = $rule->component_id_1 === $component->id ? $rule->componentTwo : $rule->componentOne;
                        @endphp
                        <div class="text-xs {{ $rule->is_compatible ? 'text-green-400' : 'text-red-400' }}">
                            <span class="font-bold">{{ $rule->is_compatible ? '[OK]' : '[NO]' }}</span>
                            {{ $other->name ?? '-' }}
                        </div>
                    @endforeach
                    @if($rules->count() > 1)
                        <p class="text-xs text-slate-500 mt-1">+{{ $rules->count() - 1 }} rule lainnya</p>
                    @endif
                </div>
                @endif

                <!-- Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('catalog.public.show', $component) }}"
                       class="flex-1 bg-slate-800 hover:bg-sky-600 text-slate-100 hover:text-white text-xs font-bold py-2.5 rounded-lg transition text-center">
                        Detail
                    </a>
                    @auth
                        <form method="POST" action="{{ route('cart.store') }}" class="flex-1">
                            @csrf
                            <input type="hidden" name="component_id" value="{{ $component->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg hover:shadow-xl">
                                Keranjang
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="flex-1 bg-slate-700 hover:bg-sky-600 text-slate-100 hover:text-white text-xs font-bold py-2.5 rounded-lg transition text-center">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $components->links() }}
    </div>
    @endif

</div>
</body>
</html>