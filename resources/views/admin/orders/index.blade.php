<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
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
            <a href="{{ route('admin.products.index') }}" class="hover:text-sky-400 transition">Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="text-sky-400 font-semibold">Orders</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
            Manage Orders
        </h1>
        <p class="text-slate-400 text-lg mt-2">Total: {{ $stats['total'] }} orders</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-xl p-4 text-center">
            <p class="text-slate-400 text-xs font-semibold mb-1">Total</p>
            <p class="text-3xl font-bold text-sky-400">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-gradient-to-br from-yellow-900/30 to-yellow-800/20 backdrop-blur border border-yellow-600/30 rounded-xl p-4 text-center">
            <p class="text-yellow-400 text-xs font-semibold mb-1"> Pending</p>
            <p class="text-3xl font-bold text-yellow-400">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-gradient-to-br from-green-900/30 to-green-800/20 backdrop-blur border border-green-600/30 rounded-xl p-4 text-center">
            <p class="text-green-400 text-xs font-semibold mb-1">Paid</p>
            <p class="text-3xl font-bold text-green-400">{{ $stats['paid'] }}</p>
        </div>
        <div class="bg-gradient-to-br from-blue-900/30 to-blue-800/20 backdrop-blur border border-blue-600/30 rounded-xl p-4 text-center">
            <p class="text-blue-400 text-xs font-semibold mb-1"> Shipped</p>
            <p class="text-3xl font-bold text-blue-400">{{ $stats['shipped'] }}</p>
        </div>
        <div class="bg-gradient-to-br from-purple-900/30 to-purple-800/20 backdrop-blur border border-purple-600/30 rounded-xl p-4 text-center">
            <p class="text-purple-400 text-xs font-semibold mb-1">Delivered</p>
            <p class="text-3xl font-bold text-purple-400">{{ $stats['delivered'] }}</p>
        </div>
    </div>
    
    <!-- Orders Table -->
    <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-800/80 border-b border-slate-700">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Order ID</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Pembeli</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Total</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Status</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Tanggal</th>
                    <th class="px-6 py-4 text-left font-bold text-sky-400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-slate-800/50 hover:bg-slate-800/30 transition">
                    <td class="px-6 py-4">
                        <span class="font-mono text-xs font-bold text-sky-300">{{ $order->order_code }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-100">{{ $order->buyer->name }}</div>
                        <div class="text-xs text-slate-500">{{ $order->buyer->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-sky-400">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs px-3 py-1 rounded-full font-bold
                            @if($order->status === 'pending')
                                bg-yellow-500/20 text-yellow-400
                            @elseif($order->status === 'paid')
                                bg-blue-500/20 text-blue-400
                            @elseif($order->status === 'processing')
                                bg-purple-500/20 text-purple-400
                            @elseif($order->status === 'shipped')
                                bg-orange-500/20 text-orange-400
                            @elseif($order->status === 'delivered')
                                bg-green-500/20 text-green-400
                            @elseif($order->status === 'cancelled')
                                bg-red-500/20 text-red-400
                            @endif">
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
                    </td>
                    <td class="px-6 py-4 text-slate-400 text-xs">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1 bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold rounded-lg transition">
                             Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                        Tidak ada order.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $orders->links() }}
    </div>

</div>

<style>
    .pagination { display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem; flex-wrap: wrap; }
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

</body>
</html>