<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Ringkasan Build</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">

<nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/95 backdrop-blur px-6 py-4">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
        </a>
        <a href="{{ route('pcbuilder') }}" class="inline-flex items-center gap-2 text-sky-300 hover:text-white transition">
            <span>←</span>
            <span class="text-sm font-medium">Kembali ke Builder</span>
        </a>
    </div>
</nav>

<div class="mx-auto max-w-5xl px-4 py-10">

    <header class="mb-10 rounded-[2rem] border border-slate-800/90 bg-gradient-to-br from-slate-900/95 to-slate-950/95 p-8 shadow-2xl shadow-slate-950/30">
        <p class="inline-flex items-center gap-2 rounded-full bg-sky-500/10 px-4 py-2 text-sm font-semibold text-sky-300 mb-4">
            Ringkasan Build PC
        </p>
        <h1 class="text-4xl font-extrabold tracking-tight text-white mb-3">Build Kamu Siap!</h1>
        <p class="text-slate-400 text-lg">Periksa kembali komponen pilihanmu sebelum melanjutkan ke checkout.</p>
    </header>

    <!-- Komponen Table -->
    <div class="mb-8 overflow-hidden rounded-[2rem] border border-slate-800/90 bg-slate-900/80 shadow-xl shadow-slate-950/40">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-800/90 bg-slate-950/90">
                    <tr>
                        <th class="px-6 py-4 text-left text-slate-300 font-semibold">Komponen</th>
                        <th class="px-6 py-4 text-left text-slate-300 font-semibold">Kategori</th>
                        <th class="px-6 py-4 text-left text-slate-300 font-semibold">Brand</th>
                        <th class="px-6 py-4 text-right text-slate-300 font-semibold">Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @foreach($components as $component)
                    <tr class="transition hover:bg-slate-800/50">
                        <td class="px-6 py-4 font-medium text-slate-100">{{ $component->name }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-300">{{ $component->category }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ $component->brand }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-sky-400">{{ $component->price_formatted }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t-2 border-slate-800/90 bg-gradient-to-r from-sky-500/5 to-blue-500/5">
                    <tr>
                        <td colspan="3" class="px-6 py-5 font-semibold text-slate-100">💰 Total Estimasi</td>
                        <td class="px-6 py-5 text-right font-extrabold text-sky-400 text-2xl">
                            Rp {{ number_format($totalHarga, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Info Build -->
    <div class="mb-8 rounded-[2rem] border border-sky-500/20 bg-sky-500/10 p-6 shadow-lg shadow-sky-500/10">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-500/20 text-sky-300 text-xl">i</div>
            <div>
                <p class="font-semibold text-sky-300 mb-1">Informasi Build</p>
                <p class="text-sm text-sky-200/90">
                    Build kamu terdiri dari <strong>{{ $components->count() }}</strong> komponen 
                    dengan total estimasi <strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>. 
                    Data ini sudah disimpan sementara dan siap untuk checkout.
                </p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="grid gap-4 sm:grid-cols-2 mb-8">
        <a href="{{ route('pcbuilder') }}"
           class="rounded-full border border-slate-700/80 bg-slate-900/90 px-6 py-4 text-center font-semibold text-slate-200 transition hover:border-sky-500 hover:text-white">
            ← Ubah Build
        </a>
        <a href="{{ route('checkout.index') }}"
           class="rounded-full bg-gradient-to-r from-blue-500 to-sky-500 px-6 py-4 text-center font-semibold text-white shadow-lg shadow-sky-500/20 transition hover:from-blue-400 hover:to-sky-400">
            Lanjut Checkout →
        </a>
    </div>

    <!-- Info Sementara -->
    <div class="rounded-[2rem] border border-amber-500/20 bg-amber-500/10 p-6 shadow-lg shadow-amber-500/10">
        <div class="flex items-start gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-amber-500/20 text-amber-300 text-lg">📝</div>
            <div>
                <p class="font-semibold text-amber-300 mb-1">Catatan</p>
                <p class="text-sm text-amber-200/90">
                    Build kamu telah tersimpan di session. Silakan lanjutkan ke halaman checkout untuk menyelesaikan pesanan.
                </p>
            </div>
        </div>
    </div>

</div>

</body>
</html>