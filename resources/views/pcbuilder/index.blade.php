<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Custom PC Builder</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">

<nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-4">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
        </a>
        <div class="flex items-center gap-4 text-sm text-slate-300">
            <a href="{{ route('catalog.public') }}" class="transition hover:text-white">Katalog</a>
            @auth
                @if(auth()->user()->role === 'buyer')
                    <a href="{{ route('buyer.dashboard') }}" class="transition hover:text-white">Dashboard</a>
                @elseif(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="transition hover:text-white">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-rose-400 hover:text-rose-200 transition">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="mx-auto max-w-7xl px-4 py-10">
    <header class="rounded-[2rem] border border-slate-800/90 bg-gradient-to-br from-slate-900/95 to-slate-950/95 p-8 shadow-2xl shadow-slate-950/30 mb-10">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div>
                <p class="inline-flex items-center gap-2 rounded-full bg-sky-500/10 px-4 py-2 text-sm font-semibold text-sky-300 mb-4">
                    PC Builder • Rakitan Cepat & Pasti Cocok
                </p>
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Rakit PC impian tanpa ribet.</h1>
                <p class="mt-4 max-w-2xl text-slate-400 text-base sm:text-lg">Pilih komponen dari CPU, motherboard, RAM, dan lainnya. Sistem kami langsung cek kompatibilitas agar rakitanmu siap dipakai dengan optimal.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('catalog.public') }}" class="inline-flex items-center justify-center rounded-full border border-slate-700/80 bg-slate-900/80 px-6 py-3 text-sm font-semibold text-slate-200 transition hover:border-blue-500 hover:text-white">
                        Jelajahi Komponen
                    </a>
                </div>
            </div>
            <div class="rounded-[1.5rem] border border-slate-800/90 bg-slate-900/80 p-6 shadow-xl shadow-slate-950/40">
                <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Ringkasannya</p>
                <div class="mt-4 space-y-4">
                    <div class="rounded-3xl bg-slate-950/80 p-4 border border-slate-800/90">
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Wajib</p>
                        <p class="mt-2 text-lg font-semibold text-white">CPU • Motherboard • RAM • PSU</p>
                    </div>
                    <div class="rounded-3xl bg-slate-950/80 p-4 border border-slate-800/90">
                        <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Opsional</p>
                        <p class="mt-2 text-lg font-semibold text-white">GPU • Storage • Case • Cooler</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="grid gap-6 lg:grid-cols-[2fr_1.05fr]">
        <section class="space-y-4">
            <div class="rounded-[2rem] border border-slate-800/90 bg-slate-900/80 p-6 shadow-xl shadow-slate-950/40">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Pilih Komponen</h2>
                        <p class="mt-2 text-slate-400">Tentukan setiap bagian rakitanmu dari daftar komponen terlengkap.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-slate-800/80 px-4 py-2 text-sm text-slate-300">Total kategori: {{ count($componentsByCategory) }}</span>
                </div>
            </div>

            <form id="builderForm" method="POST" action="{{ route('pcbuilder.summary') }}" class="space-y-5">
                @csrf

                @php
                    $icons = ['CPU'=>'CPU','GPU'=>'GPU','RAM'=>'RAM','Motherboard'=>'MOBO','PSU'=>'PSU','Storage'=>'SSD','Case'=>'CASE','Cooler'=>'COOLER'];
                    $required = ['CPU','Motherboard','RAM','PSU'];
                @endphp

                @foreach($componentsByCategory as $category => $components)
                <div class="overflow-hidden rounded-[1.75rem] border border-slate-800/90 bg-slate-900/90 p-5 shadow-sm shadow-slate-950/10">
                    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-800 text-2xl">{{ $icons[$category] ?? 'BOX' }}</div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $category }}</h3>
                                <p class="text-sm text-slate-400">{{ in_array($category, $required) ? 'Komponen wajib' : 'Komponen opsional' }}</p>
                            </div>
                        </div>
                        <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400 bg-slate-950/80">{{ in_array($category, $required) ? 'Wajib' : 'Opsional' }}</span>
                    </div>

                    @if($components->isEmpty())
                        <p class="text-slate-500 text-sm">Tidak ada produk {{ $category }} tersedia.</p>
                    @else
                        <select name="components[{{ $category }}]"
                                class="component-select w-full rounded-2xl border border-slate-700/90 bg-slate-950 px-4 py-3 text-sm text-slate-200 outline-none transition focus:border-sky-400 focus:ring-2 focus:ring-sky-500/20"
                                data-category="{{ $category }}"
                                onchange="onComponentChange()">
                            <option value="" class="text-slate-500">-- Tidak dipilih --</option>
                            @foreach($components as $component)
                            <option value="{{ $component->id }}"
                                    data-price="{{ $component->price }}"
                                    data-name="{{ $component->name }}"
                                    class="bg-slate-950 text-slate-100">
                                {{ $component->name }} — {{ $component->price_formatted }} (Stok: {{ $component->stock }})
                            </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                @endforeach

                <button type="submit" id="btnCheckout" class="w-full rounded-full bg-gradient-to-r from-blue-500 to-sky-500 px-6 py-4 text-lg font-semibold text-white shadow-lg shadow-sky-500/20 transition hover:from-blue-400 hover:to-sky-400">
                    Lanjut ke Ringkasan →
                </button>
            </form>
        </section>

        <aside class="space-y-5">
            <div class="rounded-[2rem] border border-slate-800/90 bg-gradient-to-br from-slate-900/90 to-slate-950/90 p-6 shadow-2xl shadow-slate-950/30 sticky top-10">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Build Kamu</p>
                        <h2 class="mt-2 text-2xl font-bold text-white">Ringkasan Komponen</h2>
                    </div>
                    <span class="rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-300">Realtime</span>
                </div>

                <div id="buildList" class="mt-6 space-y-3 min-h-[10rem] rounded-[1.5rem] border border-slate-800/90 bg-slate-950/90 p-4 text-sm text-slate-400">
                    <p class="text-center text-slate-500 py-8">Belum ada komponen dipilih.</p>
                </div>

                <div class="mt-6 rounded-[1.5rem] border border-slate-800/90 bg-slate-950/90 p-5">
                    <div class="flex items-center justify-between text-slate-400">
                        <span>Estimasi Total</span>
                        <span class="text-slate-500 text-xs">Auto update</span>
                    </div>
                    <p id="totalHarga" class="mt-3 text-3xl font-extrabold text-sky-400">Rp 0</p>
                </div>

                <div id="compatStatus" class="mt-5 rounded-[1.5rem] border border-slate-800/90 bg-slate-950/90 p-4 text-sm text-slate-300">
                    Pilih komponen untuk cek kompatibilitas.
                </div>

                <button onclick="checkCompatibility()" class="mt-5 w-full rounded-full border border-sky-500/50 bg-slate-900/90 px-5 py-3 text-sm font-semibold text-sky-300 transition hover:bg-slate-900 hover:text-white">
                    Cek Kompatibilitas
                </button>
            </div>

            <div class="rounded-[2rem] border border-slate-800/90 bg-slate-900/90 p-6 shadow-xl shadow-slate-950/30">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-sky-500/10 text-sky-300">TIP</div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Tips Merakit PC</h3>
                        <p class="text-slate-500 text-sm">Panduan singkat agar rakitanmu lebih aman dan optimal.</p>
                    </div>
                </div>
                <ul class="mt-5 space-y-3 text-sm text-slate-300">
                    <li class="rounded-2xl border border-slate-800/90 bg-slate-950/80 p-3">Pastikan socket CPU cocok dengan motherboard.</li>
                    <li class="rounded-2xl border border-slate-800/90 bg-slate-950/80 p-3">Pilih RAM sesuai tipe (DDR4/DDR5) motherboard.</li>
                    <li class="rounded-2xl border border-slate-800/90 bg-slate-950/80 p-3">Wattage PSU harus cukup untuk semua komponen.</li>
                    <li class="rounded-2xl border border-slate-800/90 bg-slate-950/80 p-3">Pastikan case muat untuk ukuran motherboard.</li>
                </ul>
            </div>
        </aside>
    </div>
</div>

<script>
const formatRupiah = (num) => 'Rp ' + num.toLocaleString('id-ID');

function onComponentChange() {
    let total = 0;
    let buildItems = [];
    let selectedIds = {};

    document.querySelectorAll('.component-select').forEach(sel => {
        const opt = sel.options[sel.selectedIndex];
        if (opt.value) {
            const price = parseFloat(opt.dataset.price) || 0;
            total += price;
            buildItems.push({ category: sel.dataset.category, name: opt.dataset.name, price });
            selectedIds[sel.dataset.category] = opt.value;
        }
    });

    document.getElementById('totalHarga').textContent = formatRupiah(total);

    const buildList = document.getElementById('buildList');
    if (buildItems.length === 0) {
        buildList.innerHTML = '<p class="text-center text-slate-500 py-8">Belum ada komponen dipilih.</p>';
    } else {
        buildList.innerHTML = buildItems.map(item => `
            <div class="flex items-start justify-between gap-4 rounded-2xl border border-slate-800/90 bg-slate-950/80 p-4 text-sm">
                <div>
                    <span class="text-xs uppercase tracking-[0.2em] text-slate-500">${item.category}</span>
                    <p class="mt-2 font-semibold text-slate-100">${item.name}</p>
                </div>
                <span class="whitespace-nowrap text-sky-300 font-semibold">${formatRupiah(item.price)}</span>
            </div>
        `).join('');
    }

    const compatStatus = document.getElementById('compatStatus');
    compatStatus.className = 'mt-5 rounded-[1.5rem] border border-slate-800/90 bg-slate-950/90 p-4 text-sm text-slate-300';
    compatStatus.textContent = 'Klik "Cek Kompatibilitas" untuk memverifikasi.';
}

async function checkCompatibility() {
    const ids = [];
    document.querySelectorAll('.component-select').forEach(sel => {
        if (sel.value) ids.push(sel.value);
    });

    const compatStatus = document.getElementById('compatStatus');
    const btn = document.querySelector('button[onclick="checkCompatibility()"]');

    if (ids.length < 2) {
        compatStatus.className = 'mt-5 rounded-[1.5rem] border border-yellow-300/20 bg-yellow-100/10 p-4 text-sm text-yellow-200';
        compatStatus.textContent = 'Pilih minimal 2 komponen untuk cek kompatibilitas.';
        return;
    }

    btn.textContent = '⏳ Mengecek...';
    btn.disabled = true;

    try {
        const response = await fetch('{{ route("pcbuilder.check") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ components: ids })
        });

        const data = await response.json();
        if (data.compatible) {
            compatStatus.className = 'mt-5 rounded-[1.5rem] border border-emerald-500/20 bg-emerald-100/10 p-4 text-sm text-emerald-200';
            compatStatus.textContent = data.message;
        } else {
            compatStatus.className = 'mt-5 rounded-[1.5rem] border border-rose-500/20 bg-rose-100/10 p-4 text-sm text-rose-200';
            let html = `<p class="font-semibold mb-2 text-white">${data.message}</p>`;
            data.issues.forEach(issue => {
                html += `<p class="text-xs mt-1 text-slate-300">X ${issue.component_1} × ${issue.component_2}: ${issue.message}</p>`;
            });
            compatStatus.innerHTML = html;
        }
    } catch (e) {
        compatStatus.className = 'mt-5 rounded-[1.5rem] border border-rose-500/20 bg-rose-100/10 p-4 text-sm text-rose-200';
        compatStatus.textContent = 'Terjadi kesalahan saat memeriksa kompatibilitas. Coba ulangi.';
        console.error(e);
    }

    btn.textContent = 'Cek Kompatibilitas';
    btn.disabled = false;
}
</script>

</body>
</html>
