<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Pembayaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
    </a>
</nav>

<div class="max-w-2xl mx-auto px-4 py-12">

    <!-- Success Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-400 to-green-600 py-10 text-center">
            <div class="text-6xl mb-3">OK</div>
            <h1 class="text-3xl font-bold text-white">Pembayaran Berhasil!</h1>
        </div>

        <div class="p-8 space-y-6">

            <!-- Order Details -->
            <div class="border-b pb-6">
                <p class="text-sm text-gray-500 mb-1">Order ID</p>
                <p class="text-xl font-mono font-bold text-gray-800">{{ $order->order_code }}</p>
            </div>

            <!-- Items -->
            <div>
                <p class="text-sm text-gray-500 mb-3 font-semibold">Komponen PC:</p>
                <div class="space-y-2">
                    @foreach($order->orderDetails as $detail)
                    <div class="flex justify-between text-sm bg-gray-50 p-3 rounded-lg">
                        <span>{{ $detail->component->name }}</span>
                        <span class="font-semibold text-blue-600">{{ $detail->component->price_formatted }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Total -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-800">Total Pembayaran</span>
                    <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-sm text-green-700">
                    <strong>Status:</strong> Pembayaran diterima<br>
                    <strong>Status Pengiriman:</strong> {{ ucfirst($order->status) }}<br>
                    <strong>📅 Tanggal Order:</strong> {{ $order->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <!-- Info Email -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-700">
                <strong>📧 Konfirmasi</strong> telah dikirim ke email kamu. Cek inbox atau folder spam jika belum masuk.
            </div>

            <!-- Tombol -->
            <div class="flex gap-4 pt-4">
                <a href="{{ route('buyer.dashboard') }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-center font-bold transition">
                    Lihat Dashboard
                </a>
                <a href="{{ route('home') }}"
                   class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-3 rounded-xl text-center font-semibold transition">
                    Kembali ke Home
                </a>
            </div>

        </div>
    </div>

    <!-- Next Steps -->
    <div class="mt-8 bg-white rounded-xl shadow p-6">
        <h2 class="font-bold text-gray-800 mb-4">Langkah Selanjutnya</h2>
        <ol class="space-y-3 text-sm text-gray-600 list-decimal list-inside">
            <li>Pesanan sedang diproses oleh seller</li>
            <li>Barang akan dikemas dan dikirim ke alamat yang kamu berikan</li>
            <li>Kamu akan menerima notifikasi untuk setiap tahap pengiriman</li>
            <li>Periksa dashboard untuk tracking terbaru</li>
        </ol>
    </div>

</div>

</body>
</html>