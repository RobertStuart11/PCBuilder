<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Detail Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-12">
        </a>
        <div class="flex items-center gap-6 text-sm">
            <a href="{{ route('admin.orders.index') }}" class="text-sky-400 hover:text-sky-300 transition">← Kembali ke Daftar</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="max-w-4xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
            Detail Order
        </h1>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-500/20 border border-green-500/50 text-green-400">
            [OK] {{ session('success') }}
        </div>
    @endif

    <!-- Main Card -->
    <div class="bg-gradient-to-br from-slate-900/80 to-slate-800/80 backdrop-blur border border-slate-800/50 rounded-2xl p-8 space-y-8">

        <!-- Order Code -->
        <div class="border-b border-slate-700 pb-6">
            <p class="text-xs text-slate-400 uppercase tracking-wide mb-2"> Kode Order</p>
            <p class="text-3xl font-bold font-mono text-sky-400">{{ $order->order_code }}</p>
            <p class="text-xs text-slate-500 mt-2">{{ $order->created_at->format('d M Y H:i') }}</p>
        </div>

        <!-- Buyer & Shipping Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wide mb-3 font-bold"> Informasi Pembeli</p>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 space-y-2">
                    <p class="font-bold text-slate-100">{{ $order->buyer->name }}</p>
                    <p class="text-sm text-slate-400">{{ $order->buyer->email }}</p>
                    <p class="text-sm text-slate-400">+62 {{ $order->buyer->phone ?? 'N/A' }}</p>
                </div>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wide mb-3 font-bold">Alamat Pengiriman</p>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                    <p class="text-sm text-slate-100">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div>
            <p class="text-xs text-slate-400 uppercase tracking-wide mb-4 font-bold">Komponen yang Dipesan</p>
            <div class="space-y-3">
                @foreach($order->orderDetails as $detail)
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 flex justify-between items-center hover:border-sky-500/50 transition">
                    <div>
                        <p class="font-semibold text-slate-100">{{ $detail->component->name }}</p>
                        <p class="text-xs text-slate-500">{{ $detail->component->brand }} • {{ $detail->component->category }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400 mb-1">Qty: {{ $detail->quantity }}</p>
                        <p class="font-bold text-sky-400">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Total -->
        <div class="bg-gradient-to-r from-sky-600/20 to-blue-600/20 border border-sky-500/50 rounded-xl p-6">
            <div class="flex justify-between items-center">
                <span class="font-bold text-lg text-slate-100"> Total</span>
                <span class="text-3xl font-extrabold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Status Update -->
        <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="border-t border-slate-700 pt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs text-slate-400 uppercase tracking-wide mb-3 font-bold">🔄 Ubah Status Order</label>
                <div class="flex gap-3">
                    <select name="status" class="flex-1 bg-slate-800/50 border border-slate-700 text-slate-100 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                        <option value="pending" class="bg-slate-900" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="paid" class="bg-slate-900" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="processing" class="bg-slate-900" {{ $order->status === 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
                        <option value="shipped" class="bg-slate-900" {{ $order->status === 'shipped' ? 'selected' : '' }}>🚚 Shipped</option>
                        <option value="delivered" class="bg-slate-900" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" class="bg-slate-900" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        
                    </select>
                    <button type="submit" class="bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white px-8 py-3 rounded-lg font-bold transition shadow-lg">
                        Update Status
                    </button>
                </div>
            </div>

            <!-- Current Status Badge -->
            <div class="flex items-center gap-3 pt-3 border-t border-slate-700">
                <span class="text-xs text-slate-400">Status Saat Ini:</span>
                <span class="text-xs px-4 py-1.5 rounded-full font-bold
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
                        'pending' => '⏳ Pending',
                        'paid' => 'Paid',
                        'processing' => '⚙️ Processing',
                        'shipped' => '🚚 Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                        default => $order->status
                    } }}
                </span>
            </div>
        </form>
    </div>

</div>

</body>
</html>