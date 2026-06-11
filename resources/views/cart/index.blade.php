<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Keranjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center sticky top-0 z-50">
    <a href="{{ route('home') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
    </a>
    <div class="flex items-center gap-4">
        <a href="{{ route('catalog.public') }}" class="text-gray-500 hover:text-gray-700 text-sm">Katalog</a>
        <a href="{{ route('pcbuilder') }}" class="text-gray-500 hover:text-gray-700 text-sm">PC Builder</a>
        @auth
            @if(auth()->user()->role === 'buyer')
                <a href="{{ route('buyer.dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button class="text-red-500 hover:text-red-700 text-sm">Logout</button>
            </form>
        @endauth
    </div>
</nav>

<div class="max-w-6xl mx-auto px-4 py-8">

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">
            [OK] {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
            X {{ session('error') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Belanja</h1>

    @if(empty($cartItems))
        <!-- Keranjang Kosong -->
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <p class="text-5xl mb-4">CART</p>
            <p class="text-gray-500 text-lg mb-6">Keranjang kamu kosong</p>
            <a href="{{ route('catalog.public') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg inline-block">
                Mulai Belanja →
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Daftar Produk -->
            <div class="lg:col-span-2">
                <!-- Compatibility Check Section -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
                    <div class="flex items-start gap-3">
                        <div class="text-2xl">TOOL</div>
                        <div class="flex-1">
                            <h3 class="font-bold text-blue-800">Cek Kompatibilitas Komponen</h3>
                            <p class="text-sm text-blue-700 mt-1">Pastikan semua komponen di keranjang saling kompatibel sebelum checkout</p>
                            <button onclick="checkCompatibility()" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold transition">
                                Cek Kompatibilitas
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Status Kompatibilitas -->
                <div id="compatStatus" class="hidden mb-6 p-4 rounded-lg text-sm border"></div>

                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <form method="POST" action="{{ route('cart.update') }}" id="cartForm">
                        @csrf
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Produk</th>
                                    <th class="text-left px-6 py-3 text-gray-500 font-medium">Harga</th>
                                    <th class="text-center px-6 py-3 text-gray-500 font-medium">Qty</th>
                                    <th class="text-right px-6 py-3 text-gray-500 font-medium">Subtotal</th>
                                    <th class="text-center px-6 py-3 text-gray-500 font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($cartItems as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $item['component']->name }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $item['component']->category }} • {{ $item['component']->brand }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $item['component']->price_formatted }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <input type="number" 
                                                   name="quantities[{{ $item['component']->id }}]"
                                                   value="{{ $item['quantity'] }}"
                                                   min="1"
                                                   max="{{ $item['component']->stock }}"
                                                   class="w-16 border border-gray-300 rounded px-2 py-1 text-center text-sm">
                                            <span class="text-xs text-gray-400">/ {{ $item['component']->stock }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-blue-600">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form method="POST" action="{{ route('cart.remove', $item['component']) }}" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Hapus dari keranjang?')"
                                                    class="text-red-500 hover:text-red-700 text-sm font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-between items-center border-t">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                Update Keranjang
                            </button>
                            <form method="POST" action="{{ route('cart.clear') }}" style="display:inline">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Kosongkan keranjang?')"
                                        class="text-red-500 hover:text-red-700 text-sm font-medium">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan Order -->
            <div class="bg-white rounded-xl shadow p-6 h-fit sticky top-24">
                <h3 class="font-bold text-gray-800 mb-4">Ringkasan</h3>

                <div class="space-y-3 mb-6 pb-6 border-b">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Jumlah Item</span>
                        <span class="font-semibold text-gray-800">{{ count($cartItems) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="flex justify-between items-center mb-2">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </p>
                </div>

                <form method="POST" action="{{ route('cart.checkout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition">
                        Lanjut Checkout →
                    </button>
                </form>

                <a href="{{ route('catalog.public') }}" class="block w-full mt-3 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 rounded-lg text-center text-sm font-semibold transition">
                    ← Lanjut Belanja
                </a>
            </div>
        </div>
    @endif

</div>

<script>
async function checkCompatibility() {
    const btn = document.querySelector('button[onclick="checkCompatibility()"]');
    const statusEl = document.getElementById('compatStatus');
    
    btn.textContent = '⏳ Mengecek...';
    btn.disabled = true;

    try {
        const response = await fetch('{{ route("cart.checkCompatibility") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        });

        const data = await response.json();
        statusEl.classList.remove('hidden');

        if (data.compatible) {
            statusEl.className = 'mt-3 p-4 rounded-lg text-sm bg-green-50 border border-green-200 text-green-700 mb-6';
            statusEl.innerHTML = `
                <p class="font-bold mb-1">${data.message}</p>
                <p>Semua komponen di keranjang kamu sudah diverifikasi dan compatible. Aman untuk checkout!</p>
            `;
        } else {
            statusEl.className = 'mt-3 p-4 rounded-lg text-sm bg-red-50 border border-red-200 text-red-700 mb-6';
            let html = `<p class="font-bold mb-2">${data.message}</p>`;
            html += '<ul class="space-y-2">';
            data.issues.forEach(issue => {
                html += `
                    <li class="p-2 bg-red-100 rounded">
                        <p class="font-semibold">${issue.component_1} X ${issue.component_2}</p>
                        <p class="text-xs mt-1">${issue.message}</p>
                    </li>
                `;
            });
            html += '</ul>';
            statusEl.innerHTML = html;
        }
    } catch (e) {
        console.error(e);
        statusEl.className = 'mt-3 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 mb-6';
        statusEl.textContent = 'Error mengecek kompatibilitas. Coba lagi.';
        statusEl.classList.remove('hidden');
    }

    btn.textContent = 'Cek Kompatibilitas';
    btn.disabled = false;
}
</script>

</body>
</html>