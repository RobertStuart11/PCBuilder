<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Dashboard Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 min-h-screen">
    <!-- Background Effects -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-12">
                <span class="text-lg font-bold bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">PCBuilder</span>
            </a>
            <div class="flex items-center gap-6 text-sm text-slate-300">
                <span class="text-green-400 font-semibold"> {{ auth()->user()->name }}</span>
                <a href="{{ route('seller.components.index') }}" class="text-slate-300 hover:text-green-400 transition">Produk Saya</a>
                <a href="{{ route('home') }}" class="text-slate-300 hover:text-blue-400 transition">Home</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-red-400 hover:text-red-300 transition">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-12">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">
                 Dashboard Seller
            </h1>
            <p class="text-slate-400 text-lg mt-2">Kelola toko dan produk Anda dengan mudah</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-blue-600/30 rounded-2xl p-6 hover:border-blue-500/60 transition">
                <p class="text-blue-400 text-sm font-bold uppercase mb-2">Total Produk</p>
                <p class="text-4xl font-extrabold text-blue-400">{{ $myComponents }}</p>
            </div>
            <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-green-600/30 rounded-2xl p-6 hover:border-green-500/60 transition">
                <p class="text-green-400 text-sm font-bold uppercase mb-2">Total Terjual</p>
                <p class="text-4xl font-extrabold text-green-400">{{ $totalTerjual }} unit</p>
            </div>
            <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-purple-600/30 rounded-2xl p-6 hover:border-purple-500/60 transition">
                <p class="text-purple-400 text-sm font-bold uppercase mb-2"> Total Pendapatan</p>
                <p class="text-3xl font-extrabold text-purple-400">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Produk Saya Section -->
        <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-700/50 rounded-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-100">Produk Saya</h2>
                <a href="{{ route('seller.components.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white font-semibold rounded-lg transition transform hover:scale-105">
                    <span>+</span> Tambah Produk
                </a>
            </div>

            <div class="text-center py-12">
                <p class="text-slate-400 text-lg mb-4">Klik "Produk Saya" di navbar untuk kelola produk lengkap</p>
                <div class="inline-block px-6 py-3 bg-slate-700/30 border border-slate-600 rounded-lg">
                    <p class="text-slate-300 text-sm">Total produk yang dikelola: <span class="font-bold text-green-400">{{ $myComponents }}</span></p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
            <a href="{{ route('seller.components.index') }}" class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border-2 border-green-600/30 hover:border-green-500/60 rounded-2xl p-6 transition duration-300 hover:shadow-lg hover:shadow-green-500/20">
                <div class="text-4xl mb-3">BOX</div>
                <h3 class="text-xl font-bold text-slate-100 group-hover:text-green-400 transition">Kelola Produk</h3>
                <p class="text-sm text-slate-400 mt-2">Edit, hapus, atau tambah produk baru</p>
            </a>

            <a href="{{ route('seller.catalog') }}" class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border-2 border-blue-600/30 hover:border-blue-500/60 rounded-2xl p-6 transition duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                <div class="text-4xl mb-3">SEARCH</div>
                <h3 class="text-xl font-bold text-slate-100 group-hover:text-blue-400 transition">Lihat Katalog</h3>
                <p class="text-sm text-slate-400 mt-2">Riset kompetitor dan cek kompatibilitas produk</p>
            </a>
        </div>
    </div>
</body>
</html>