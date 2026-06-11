<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Dashboard Buyer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 min-h-screen">
    <!-- Background Effects -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <a href="{{ route('buyer.dashboard') }}" class="inline-flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-12">
                <span class="text-lg font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">PCBuilder</span>
            </a>
            <div class="flex items-center gap-6 text-sm text-slate-300">
                <span class="text-sky-400 font-semibold"> {{ auth()->user()->name }}</span>
                <a href="{{ route('catalog.public') }}" class="text-slate-300 hover:text-blue-400 transition">📚 Katalog</a>
                <a href="{{ route('cart.index') }}" class="text-slate-300 hover:text-blue-400 transition">Keranjang</a>
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
            <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
                 Dashboard Buyer
            </h1>
            <p class="text-slate-400 text-lg mt-2">Kelola pesanan dan temukan komponen PC terbaik</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-blue-600/30 rounded-2xl p-6 hover:border-blue-500/60 transition">
                <p class="text-blue-400 text-sm font-bold uppercase mb-2">Total Pesanan</p>
                <p class="text-4xl font-extrabold text-blue-400">{{ $totalOrders }}</p>
            </div>
            <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-green-600/30 rounded-2xl p-6 hover:border-green-500/60 transition">
                <p class="text-green-400 text-sm font-bold uppercase mb-2">Role</p>
                <p class="text-4xl font-extrabold text-green-400">Buyer</p>
            </div>
            <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-purple-600/30 rounded-2xl p-6 hover:border-purple-500/60 transition">
                <p class="text-purple-400 text-sm font-bold uppercase mb-2">Status Akun</p>
                <p class="text-4xl font-extrabold text-purple-400">Aktif</p>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-700/50 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-slate-100 mb-6">Pesanan Terbaru</h2>
            @forelse($recentOrders as $order)
                <div class="border-b border-slate-700/50 last:border-b-0 py-4 flex justify-between items-center hover:bg-slate-700/30 px-4 rounded transition">
                    <div class="flex-1">
                        <span class="font-mono text-sm text-blue-400">Order #{{ $order->id }}</span>
                        <p class="text-xs text-slate-400 mt-1">{{ $order->created_at?->format('d M Y H:i') }}</p>
                    </div>
                    <span class="text-sm px-3 py-1 rounded-full bg-slate-700/50 text-slate-300">
                        {{ $order->status ?? 'pending' }}
                    </span>
                    <span class="text-sm font-semibold text-green-400 ml-4">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</span>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-slate-400 text-lg mb-4">Belum ada pesanan </p>
                    <a href="{{ route('catalog.public') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold rounded-lg transition transform hover:scale-105">
                        🛍️ Mulai Belanja Sekarang
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
            <a href="{{ route('catalog.public') }}" class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border-2 border-cyan-600/30 hover:border-cyan-500/60 rounded-2xl p-6 transition duration-300 hover:shadow-lg hover:shadow-cyan-500/20">
                <div class="text-4xl mb-3">SEARCH</div>
                <h3 class="text-xl font-bold text-slate-100 group-hover:text-cyan-400 transition">Jelajahi Katalog</h3>
                <p class="text-sm text-slate-400 mt-2">Temukan ribuan komponen PC pilihan</p>
            </a>

            <a href="{{ route('pcbuilder') }}" class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border-2 border-purple-600/30 hover:border-purple-500/60 rounded-2xl p-6 transition duration-300 hover:shadow-lg hover:shadow-purple-500/20">
                <div class="text-4xl mb-3">🛠️</div>
                <h3 class="text-xl font-bold text-slate-100 group-hover:text-purple-400 transition">PC Builder</h3>
                <p class="text-sm text-slate-400 mt-2">Rakit PC impianmu dengan cek kompatibilitas</p>
            </a>
        </div>
    </div>
</body>
</html>