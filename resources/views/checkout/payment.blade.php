<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
    </a>
</nav>

<div class="max-w-2xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran</h1>
    <p class="text-gray-500 text-sm mb-8">Pilih metode pembayaran dan selesaikan transaksi.</p>

    <div class="bg-white rounded-xl shadow p-8">
        
        <!-- Order Summary -->
        <div class="mb-8 pb-8 border-b">
            <p class="text-gray-600 text-center">
                Order #<strong class="font-mono">{{ $order->order_code }}</strong><br>
                Total: <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </p>
        </div>

        <!-- Payment Methods -->
        <div class="mb-8">
            <h2 class="font-bold text-gray-800 mb-4">Pilih Metode Pembayaran</h2>
            
            <form method="POST" action="{{ route('checkout.process', $order) }}" id="paymentForm">
                @csrf

                <div class="space-y-3">
                    <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="payment_method" value="transfer" checked required class="w-5 h-5 text-blue-600">
                        <div>
                            <p class="font-medium text-gray-800">Transfer Bank</p>
                            <p class="text-xs text-gray-500">BCA, Mandiri, BRI, BNI</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="payment_method" value="ewallet" required class="w-5 h-5 text-blue-600">
                        <div>
                            <p class="font-medium text-gray-800">E-Wallet</p>
                            <p class="text-xs text-gray-500">GCash, OVO, DANA, LinkAja</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="payment_method" value="kartu_kredit" required class="w-5 h-5 text-blue-600">
                        <div>
                            <p class="font-medium text-gray-800">Kartu Kredit</p>
                            <p class="text-xs text-gray-500">Visa, Mastercard, AmEx</p>
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold text-lg transition">
                    Bayar Sekarang — Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </button>
            </form>
        </div>

        <!-- Info Demo -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-xs text-yellow-700">
                <strong>DEMO MODE:</strong> Ini adalah mode demo untuk testing. Klik "Bayar Sekarang" untuk mensimulasikan pembayaran berhasil.
            </p>
        </div>
    </div>

    <!-- Info -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-4">
        <p class="text-sm text-blue-700 font-medium mb-2">Informasi</p>
        <p class="text-xs text-blue-600">
            Sistem pembayaran ini adalah simulasi untuk keperluan demo & testing. 
            Pada production environment, akan diintegrasikan dengan payment gateway asli seperti Midtrans, Xendit, atau Stripe.
        </p>
    </div>

</div>

</body>
</html>