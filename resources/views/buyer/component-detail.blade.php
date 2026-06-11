<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - {{ $component->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">

<nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-12">
        </a>
        <div class="flex items-center gap-6 text-sm text-slate-300">
            <a href="{{ route('catalog.public') }}" class="hover:text-sky-400 transition">← Katalog</a>
            @auth
                @if(auth()->user()->role === 'buyer')
                    <a href="{{ route('cart.index') }}" class="relative hover:text-sky-400 transition font-medium flex items-center gap-2">
                        Keranjang
                        @php $cartCount = count(session('cart', [])) @endphp
                        @if($cartCount > 0)
                            <span class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('buyer.dashboard') }}" class="hover:text-sky-400 transition">Dashboard</a>
                @elseif(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="hover:text-sky-400 transition">Dashboard</a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-400 transition">Admin Panel</a>
                @endif
            @endauth
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-12">

    <!-- Breadcrumb -->
    <p class="text-sm text-slate-400 mb-8">
        <a href="{{ route('catalog.public') }}" class="hover:text-sky-400 transition">Katalog</a>
        → <span class="text-slate-300">{{ $component->name }}</span>
    </p>

    <!-- Detail Utama -->
    <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-2xl shadow-lg p-8 flex flex-col md:flex-row gap-8 mb-8">

        <!-- Gambar -->
        <div class="md:w-80 flex-shrink-0">
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
            <div class="w-full h-72 rounded-2xl border border-slate-700 overflow-hidden flex items-center justify-center">
                @if($component->image)
                    <img src="{{ $component->image_url }}" alt="{{ $component->name }}"
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                @else
                    <div class="w-full h-full bg-gradient-to-br {{ $colorMap[$component->category] ?? 'from-slate-700 to-slate-900' }} flex items-center justify-center">
                        <div class="text-center">
                            <span class="text-white text-6xl block mb-2">{{ $component->category === 'CPU' ? 'CPU' : ($component->category === 'GPU' ? 'GPU' : ($component->category === 'RAM' ? 'RAM' : ($component->category === 'Motherboard' ? 'MOBO' : ($component->category === 'PSU' ? 'PSU' : ($component->category === 'Storage' ? 'SSD' : ($component->category === 'Case' ? 'CASE' : 'COOLER')))))) }}</span>
                            <span class="text-white font-bold text-lg drop-shadow-lg">{{ $component->category }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info -->
        <div class="flex-1">
            <span class="text-xs font-bold px-3 py-1 rounded-full bg-sky-500/90 text-white">{{ $component->category }}</span>
            <h1 class="text-4xl font-bold text-slate-100 mt-4">{{ $component->name }}</h1>
            <p class="text-slate-400 text-sm mt-2">Brand: <span class="text-slate-200 font-medium">{{ $component->brand }}</span></p>
            <p class="text-slate-400 text-sm">Seller: <span class="text-slate-200">{{ $component->seller->name ?? '-' }}</span></p>

            <p class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent mt-6">{{ $component->price_formatted }}</p>

            <div class="flex items-center gap-2 mt-3 pb-6 border-b border-slate-700">
                <span class="text-sm text-slate-400">Stok:</span>
                <span class="text-sm font-bold {{ $component->stock < 5 ? 'text-red-400' : 'text-green-400' }}">
                    {{ $component->stock > 0 ? $component->stock . ' unit tersedia' : 'Habis' }}
                </span>
            </div>

            @if($component->description)
            <div class="mt-6 bg-slate-800/50 rounded-xl p-4 border border-slate-700">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-2">Deskripsi Produk</p>
                <p class="text-sm text-slate-300 leading-relaxed">{{ $component->description }}</p>
            </div>
            @endif

            @auth
                @if($component->stock > 0)
                    <form method="POST" action="{{ route('cart.store') }}" class="mt-8">
                        @csrf
                        <input type="hidden" name="component_id" value="{{ $component->id }}">
                        <div class="flex gap-4 items-end">
                            <div>
                                <label class="text-xs text-slate-400 uppercase tracking-wide mb-2 block">Jumlah:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $component->stock }}"
                                       class="w-24 bg-slate-800/50 border border-slate-700 text-slate-100 rounded-lg px-3 py-2.5 text-center text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                            </div>
                            <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3 rounded-xl font-semibold transition shadow-lg hover:shadow-xl">
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                @else
                    <button disabled class="mt-8 w-full bg-slate-700/50 text-slate-400 px-8 py-3 rounded-xl font-semibold cursor-not-allowed">
                        Stok Habis
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-block mt-8 bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition shadow-lg">
                    Login untuk Membeli
                </a>
            @endauth
        </div>
    </div>

    <!-- Kompatibilitas -->
    @if($rules->isNotEmpty())
    <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-2xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-100 mb-6 flex items-center gap-2">Informasi Kompatibilitas</h2>
        <div class="space-y-3">
            @foreach($rules as $rule)
            @php
                $other = $rule->component_id_1 === $component->id
                    ? $rule->componentTwo
                    : $rule->componentOne;
            @endphp
            <div class="flex items-start gap-3 p-4 rounded-xl {{ $rule->is_compatible ? 'bg-green-500/10 border border-green-500/20' : 'bg-red-500/10 border border-red-500/20' }}">
                <span class="text-lg mt-0.5 font-bold {{ $rule->is_compatible ? 'text-green-400' : 'text-red-400' }}">{{ $rule->is_compatible ? 'YES' : 'NO' }}</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold {{ $rule->is_compatible ? 'text-green-400' : 'text-red-400' }}">
                        {{ $rule->is_compatible ? 'Kompatibel' : 'Tidak Kompatibel' }} dengan
                        <strong class="text-slate-100">{{ $other->name ?? '-' }}</strong>
                    </p>
                    @if($rule->description)
                        <p class="text-xs text-slate-400 mt-1">{{ $rule->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Produk Terkait -->
    @if($related->isNotEmpty())
    <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-slate-100 mb-6">Produk {{ $component->category }} Lainnya</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
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
            @foreach($related as $item)
            <a href="{{ route('catalog.public.show', $item) }}"
               class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-xl overflow-hidden hover:border-sky-500/50 hover:shadow-lg transition-all duration-300 text-center">
                <div class="h-32 bg-gradient-to-br {{ $colorMap[$item->category] ?? 'from-slate-700 to-slate-900' }} flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-white font-bold text-xs drop-shadow-lg">{{ $item->category }}</span>
                </div>
                <div class="p-4">
                    <p class="text-xs font-medium text-slate-300 line-clamp-2 mb-2">{{ $item->name }}</p>
                    <p class="text-sm font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">{{ $item->price_formatted }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

</body>
</html>