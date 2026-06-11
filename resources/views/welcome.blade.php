<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder — Custom PC Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-white">

    <!-- NAVBAR -->
    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-2 flex justify-between items-center sticky top-0 z-50">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('catalog.public') }}" class="text-gray-300 hover:text-white text-sm">Katalog</a>
            <a href="#builder" class="text-gray-300 hover:text-white text-sm">PC Builder</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Dashboard</a>
                @elseif(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Dashboard</a>
                @else
                    <a href="{{ route('buyer.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Dashboard</a>
                @endif
                <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-white text-sm font-medium">
                    Keranjang
                    @php $cartCount = count(session('cart', [])) @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">{{ $cartCount }}</span>
                    @endif
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-gray-400 hover:text-red-400 text-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- HERO -->
    <section class="relative overflow-hidden text-center py-24 px-4 bg-slate-950">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(59,130,246,0.25),transparent_18%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.16),transparent_22%)]"></div>
        <div class="relative mx-auto max-w-6xl">
            <div class="inline-flex items-center gap-3 rounded-full border border-blue-500/20 bg-blue-600/10 px-4 py-2 text-sm text-blue-300 shadow-sm shadow-blue-500/10 mb-4">
                Marketplace Komponen PC #1 Indonesia
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight text-slate-100">
                Rakit PC Impianmu<br>
                <span class="text-blue-400">Dengan Mudah & Cepat</span>
            </h1>
            <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">
                Temukan ribuan komponen PC original, cek kompatibilitas otomatis, dan beli langsung dari seller terpercaya dengan pengalaman rakit yang lebih lancar.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('pcbuilder') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-sky-500 hover:from-blue-500 hover:to-sky-400 text-white px-10 py-4 rounded-2xl font-semibold text-lg shadow-lg shadow-blue-500/20 transition">
                    Mulai Rakit PC
                </a>
                <a href="{{ route('catalog.public') }}" class="inline-flex items-center justify-center border border-slate-700/80 hover:border-blue-500 bg-slate-900/90 text-slate-100 px-10 py-4 rounded-2xl font-semibold text-lg transition">
                    Jelajahi Katalog
                </a>
            </div>

            <!-- Stats -->
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 text-left sm:text-center">
                <div class="rounded-3xl border border-slate-800/80 bg-slate-900/80 p-6 shadow-xl shadow-slate-950/20">
                    <p class="text-4xl font-extrabold text-blue-400">500+</p>
                    <p class="text-slate-400 mt-2">Produk Komponen</p>
                </div>
                <div class="rounded-3xl border border-slate-800/80 bg-slate-900/80 p-6 shadow-xl shadow-slate-950/20">
                    <p class="text-4xl font-extrabold text-green-400">100+</p>
                    <p class="text-slate-400 mt-2">Seller Terpercaya</p>
                </div>
                <div class="rounded-3xl border border-slate-800/80 bg-slate-900/80 p-6 shadow-xl shadow-slate-950/20">
                    <p class="text-4xl font-extrabold text-purple-400">10K+</p>
                    <p class="text-slate-400 mt-2">Transaksi Sukses</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KATEGORI -->
    <section class="py-16 px-6 bg-slate-950">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-100">Kategori Komponen</h2>
                    <p class="text-slate-400 mt-2">Pilih kategori komponen yang kamu butuhkan untuk mulai merakit PC terbaik.</p>
                </div>
                <a href="{{ route('catalog.public') }}" class="inline-flex items-center justify-center rounded-full border border-slate-700/80 bg-slate-900/90 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:border-blue-500">
                    Lihat Semua Komponen
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                @foreach([
                    ['CPU','CPU','blue'],
                    ['GPU','GPU','purple'],
                    ['RAM','RAM','green'],
                    ['Motherboard','MOBO','orange'],
                    ['PSU','PSU','yellow'],
                    ['Storage','SSD','red'],
                    ['Case','CASE','indigo'],
                    ['Cooler','COOLER','cyan'],
                ] as [$cat, $icon, $color])
                <div class="rounded-3xl border border-slate-800/90 bg-slate-900/80 p-6 text-center transition hover:-translate-y-1 hover:border-{{ $color }}-500 hover:bg-slate-900 shadow-xl shadow-slate-950/20 cursor-pointer">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-800 text-3xl text-white">
                        {{ $icon }}
                    </div>
                    <div class="text-sm font-semibold text-slate-100">{{ $cat }}</div>
                    <div class="mt-2 text-xs text-slate-400">Temukan pilihan terbaik untuk kategori ini.</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK -->
    <section id="katalog" class="py-16 px-6 bg-gray-900">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl font-bold">Produk Terbaru</h2>
                <span class="text-gray-400 text-sm">{{ $components->count() }} produk tersedia</span>
            </div>

            @if($components->isEmpty())
                <div class="text-center py-16 text-gray-500">
                    <p class="text-5xl mb-4">BOX</p>
                    <p>Belum ada produk tersedia.</p>
                </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($components as $component)
                <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden hover:border-blue-500 hover:shadow-lg hover:shadow-blue-900/20 transition group">
                    <!-- Gambar / placeholder -->
                    <div class="bg-gray-700 h-40 flex items-center justify-center text-5xl overflow-hidden">
                        @if($component->image)
                            <img src="{{ $component->image_url }}" alt="{{ $component->name }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                        @else
                            @php
                                $icons = ['CPU'=>'CPU','GPU'=>'GPU','RAM'=>'RAM','Motherboard'=>'MOBO','PSU'=>'PSU','Storage'=>'SSD','Case'=>'CASE','Cooler'=>'COOLER'];
                            @endphp
                            {{ $icons[$component->category] ?? 'BOX' }}
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-xs text-blue-400 bg-blue-900/30 px-2 py-0.5 rounded-full">{{ $component->category }}</span>
                        <h3 class="font-semibold mt-2 text-sm leading-snug group-hover:text-blue-300">{{ $component->name }}</h3>
                        <p class="text-gray-400 text-xs mt-1">{{ $component->brand }}</p>
                        
                        <!-- Specs -->
                        @if($component->description)
                        <p class="text-gray-500 text-xs mt-2 line-clamp-1">{{ $component->description }}</p>
                        @endif
                        
                        <!-- Compatibility -->
                        @php
                            $rules = $component->compatibilityAsFirst()->take(1)->get()
                                ->concat($component->compatibilityAsSecond()->take(1)->get());
                        @endphp
                        @if($rules->isNotEmpty())
                        @foreach($rules as $rule)
                            @php
                                $other = $rule->component_id_1 === $component->id ? $rule->componentTwo : $rule->componentOne;
                            @endphp
                            <div class="text-xs {{ $rule->is_compatible ? 'text-green-400' : 'text-red-400' }} mt-2">
                                <span class="font-bold">{{ $rule->is_compatible ? '[Compatible]' : '[Incompatible]' }}</span> dengan {{ substr($other->name ?? '-', 0, 20) }}...
                            </div>
                        @endforeach
                        @endif
                        
                        <div class="flex justify-between items-center mt-3">
                            <span class="text-blue-400 font-bold text-sm">{{ $component->price_formatted }}</span>
                            <span class="text-xs text-gray-500">Stok: {{ $component->stock }}</span>
                        </div>
                        <button class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white text-xs py-2 rounded-lg transition">
                            + Keranjang
                        </button>
                    </div>
                            <span class="text-xs text-gray-500">Stok: {{ $component->stock }}</span>
                        </div>
                        <button class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white text-xs py-2 rounded-lg transition">
                            + Keranjang
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- PC BUILDER CTA -->
    <section id="builder" class="py-20 px-6 bg-slate-950">
        <div class="max-w-6xl mx-auto grid gap-10 lg:grid-cols-[1.4fr_1fr] items-center">
            <div class="rounded-[2rem] border border-slate-800/90 bg-slate-900/80 p-10 shadow-xl shadow-slate-950/30">
                <p class="text-blue-400 text-sm font-semibold mb-3">Fitur Unggulan</p>
                <h2 class="text-4xl font-extrabold mb-4 text-slate-100">Custom PC Builder</h2>
                <p class="text-slate-400 mb-8 leading-relaxed">Pilih komponen satu per satu, sistem kami otomatis mengecek kompatibilitas antar komponen secara real-time. Tidak perlu khawatir salah beli.</p>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-slate-800/90 bg-slate-950/80 p-5 text-center">
                        <p class="text-3xl mb-3">TOOL</p>
                        <p class="font-semibold text-slate-100">Pilih Komponen</p>
                        <p class="text-xs text-slate-500 mt-2">Dari ratusan pilihan terpercaya.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-800/90 bg-slate-950/80 p-5 text-center">
                        <p class="text-3xl mb-3">OK</p>
                        <p class="font-semibold text-slate-100">Cek Kompatibilitas</p>
                        <p class="text-xs text-slate-500 mt-2">Otomatis dan real-time.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-800/90 bg-slate-950/80 p-5 text-center">
                        <p class="text-3xl mb-3">CART</p>
                        <p class="font-semibold text-slate-100">Checkout Cepat</p>
                        <p class="text-xs text-slate-500 mt-2">Langsung beli tanpa susah.</p>
                    </div>
                </div>
                <div class="mt-10">
                    @auth
                        <a href="{{ route('pcbuilder') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-sky-500 px-10 py-4 text-lg font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:from-blue-500 hover:to-sky-400">
                            Mulai Rakit Sekarang →
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-sky-500 px-10 py-4 text-lg font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:from-blue-500 hover:to-sky-400">
                            Daftar & Mulai Rakit →
                        </a>
                    @endauth
                </div>
            </div>
            <div class="rounded-[2rem] border border-slate-800/80 bg-gradient-to-br from-slate-900/90 to-slate-950/80 p-8 shadow-2xl shadow-slate-950/30">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-slate-400 uppercase text-xs tracking-[0.25em]">Build Kamu</p>
                        <h3 class="text-xl font-bold text-slate-100 mt-2">Rakit dalam 3 langkah</h3>
                    </div>
                    <span class="rounded-full bg-blue-600/15 px-3 py-1 text-blue-300 text-xs">Cepat & Aman</span>
                </div>
                <div class="space-y-4 text-slate-400">
                    <div class="rounded-3xl bg-slate-900/80 border border-slate-800/90 p-4">
                        <p class="text-sm font-semibold text-slate-100">1. Pilih CPU & Motherboard</p>
                        <p class="text-xs mt-2">Pastikan socket cocok untuk performa maksimal.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-900/80 border border-slate-800/90 p-4">
                        <p class="text-sm font-semibold text-slate-100">2. Tambahkan RAM, PSU, dan Storage</p>
                        <p class="text-xs mt-2">Semua komponen diperiksa kompatibilitas otomatis.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-900/80 border border-slate-800/90 p-4">
                        <p class="text-sm font-semibold text-slate-100">3. Checkout dalam hitungan menit</p>
                        <p class="text-xs mt-2">Bayar, konfirmasi, dan tunggu PC impianmu dikirim.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 border-t border-gray-800 py-8 px-6 text-center text-gray-500 text-sm">
        <p class="font-bold text-white text-lg mb-2">PCBuilder</p>
        <p>© 2026 PCBuilder. Platform marketplace komponen PC terpercaya di Indonesia.</p>
    </footer>

</body>
</html>