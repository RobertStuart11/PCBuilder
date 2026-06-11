<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Admin Dashboard</title>
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
            <span class="text-sky-400 font-semibold"> {{ auth()->user()->name }}</span>
            <a href="{{ route('home') }}" class="text-slate-300 hover:text-blue-400 transition">Home</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
            🎛️ Admin Dashboard
        </h1>
        <p class="text-slate-400 text-lg mt-2">Selamat datang kembali, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
        <a href="{{ route('admin.products.index') }}" class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border-2 border-slate-800/50 hover:border-sky-500/50 rounded-2xl p-8 transition duration-300 hover:shadow-lg hover:shadow-sky-500/20">
            <div class="flex items-center justify-between mb-4">
                <div class="text-5xl">BOX</div>
                <span class="text-3xl font-bold text-sky-400 group-hover:text-sky-300">{{ $totalComponents }}</span>
            </div>
            <h3 class="text-xl font-bold text-slate-100 group-hover:text-sky-300 transition">Manage Produk</h3>
            <p class="text-sm text-slate-400 mt-1">Edit, hapus, atau upload gambar produk</p>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="group bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border-2 border-slate-800/50 hover:border-green-500/50 rounded-2xl p-8 transition duration-300 hover:shadow-lg hover:shadow-green-500/20">
            <div class="flex items-center justify-between mb-4">
                <div class="text-5xl">CART</div>
                <span class="text-3xl font-bold text-green-400 group-hover:text-green-300">{{ $totalOrders }}</span>
            </div>
            <h3 class="text-xl font-bold text-slate-100 group-hover:text-green-300 transition">Manage Orders</h3>
            <p class="text-sm text-slate-400 mt-1">Lihat dan ubah status semua orders</p>
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-12">
        <div class="bg-gradient-to-br from-blue-900/30 to-blue-800/20 backdrop-blur border border-blue-600/30 rounded-xl p-6 text-center">
            <p class="text-blue-400 text-xs font-bold uppercase mb-2"> Total User</p>
            <p class="text-4xl font-extrabold text-blue-400">{{ $totalUsers }}</p>
        </div>

        <div class="bg-gradient-to-br from-green-900/30 to-green-800/20 backdrop-blur border border-green-600/30 rounded-xl p-6 text-center">
            <p class="text-green-400 text-xs font-bold uppercase mb-2"> Seller</p>
            <p class="text-4xl font-extrabold text-green-400">{{ $totalSeller }}</p>
        </div>

        <div class="bg-gradient-to-br from-purple-900/30 to-purple-800/20 backdrop-blur border border-purple-600/30 rounded-xl p-6 text-center">
            <p class="text-purple-400 text-xs font-bold uppercase mb-2"> Buyer</p>
            <p class="text-4xl font-extrabold text-purple-400">{{ $totalBuyer }}</p>
        </div>

        <div class="bg-gradient-to-br from-orange-900/30 to-orange-800/20 backdrop-blur border border-orange-600/30 rounded-xl p-6 text-center">
            <p class="text-orange-400 text-xs font-bold uppercase mb-2">Komponen</p>
            <p class="text-4xl font-extrabold text-orange-400">{{ $totalComponents }}</p>
        </div>

        <div class="bg-gradient-to-br from-red-900/30 to-red-800/20 backdrop-blur border border-red-600/30 rounded-xl p-6 text-center">
            <p class="text-red-400 text-xs font-bold uppercase mb-2">Orders</p>
            <p class="text-4xl font-extrabold text-red-400">{{ $totalOrders }}</p>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-2xl p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-100">Order Terbaru</h2>
                <p class="text-slate-400 text-sm mt-1">5 orders terakhir yang masuk</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold rounded-lg transition">
                Lihat Semua →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($recentOrders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="flex justify-between items-center p-4 rounded-lg bg-slate-800/50 border border-slate-700/50 hover:border-sky-500/50 transition group">
                    <div class="flex-1">
                        <div class="font-mono text-sm font-bold text-sky-400">{{ $order->order_code }}</div>
                        <div class="text-xs text-slate-400 mt-1">
                            {{ $order->buyer->name ?? '-' }} • {{ $order->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xs px-3 py-1 rounded-full font-bold
                            {{ $order->status === 'delivered' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ match($order->status) {
                                'pending' => ' Pending',
                                'paid' => 'Paid',
                                'processing' => ' Processing',
                                'shipped' => ' Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                                default => $order->status
                            } }}
                        </span>
                        <span class="font-bold text-sky-400 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        <span class="text-slate-500 group-hover:text-sky-400 transition">→</span>
                    </div>
                </a>
            @empty
                <div class="text-center py-12 text-slate-400">
                     Belum ada order masuk.
                </div>
            @endforelse
        </div>
    </div>

</div>

</body>
</html>