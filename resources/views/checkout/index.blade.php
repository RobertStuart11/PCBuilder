<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
    </a>
    <a href="{{ route('pcbuilder') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Kembali ke Builder</a>
</nav>

<div class="max-w-5xl mx-auto px-4 py-8">

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-800 mb-2">Checkout</h1>
    <p class="text-gray-500 text-sm mb-8">Masukkan alamat pengiriman dan lanjut ke pembayaran.</p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Form Alamat -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="font-bold text-gray-800 mb-4">Alamat Pengiriman</h2>

                <form method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
                    @csrf

                    <!-- Nama (readonly) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                        <input type="text" value="{{ $user->name }}" readonly
                               class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-gray-600">
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               placeholder="081234567890"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Alamat Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="shipping_address" rows="4"
                                  placeholder="Jl. Raya No. 123, Kota, Provinsi, Kode Pos"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('shipping_address', $user->address) }}</textarea>
                        @error('shipping_address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Metode Pengiriman (dummy) -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="radio" name="shipping_method" value="standart" checked class="w-4 h-4">
                            <span class="text-sm">
                                <span class="font-medium text-gray-700">Standar</span> — Gratis ongkir
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-lg transition mt-6">
                        Lanjut ke Pembayaran →
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-xl shadow p-6 h-fit">
            <h3 class="font-bold text-gray-800 mb-4">Ringkasan Order</h3>

            <div class="space-y-3 mb-4 max-h-96 overflow-y-auto">
                @foreach($components as $component)
                <div class="flex justify-between items-start text-sm pb-3 border-b border-gray-100">
                    <div>
                        <p class="font-medium text-gray-700">{{ $component->name }}</p>
                        <p class="text-xs text-gray-400">{{ $component->category }}</p>
                    </div>
                    <span class="text-blue-600 font-semibold whitespace-nowrap ml-2">{{ $component->price_formatted }}</span>
                </div>
                @endforeach
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-gray-500 text-sm">Subtotal</span>
                    <span class="font-semibold text-gray-800">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-500 text-sm">Ongkir</span>
                    <span class="font-semibold text-green-600">Gratis</span>
                </div>
                <div class="border-t pt-3 flex justify-between items-center">
                    <span class="font-bold text-gray-800">Total</span>
                    <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                <p class="text-xs text-blue-700">
                    <strong>Metode Pembayaran:</strong> Midtrans (Transfer Bank, E-Wallet, dll)
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>