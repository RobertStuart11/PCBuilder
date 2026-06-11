<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Produk</title>
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
            <a href="{{ route('admin.orders.index') }}" class="hover:text-sky-400 transition">Orders</a>
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
        <a href="{{ route('admin.products.index') }}" class="text-sky-400 hover:text-sky-300 transition text-sm mb-4 inline-block">← Kembali ke Daftar</a>
        <h1 class="text-4xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">
             Edit Produk
        </h1>
        <p class="text-slate-400 text-lg mt-2">{{ $component->name }}</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.products.update', $component) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-sky-400 mb-2"> Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $component->name) }}"
                       class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 placeholder-slate-500 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Brand & Category -->
            <div>
                <label class="block text-sm font-bold text-sky-400 mb-2"> Brand</label>
                <input type="text" name="brand" value="{{ old('brand', $component->brand) }}"
                       class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 placeholder-slate-500 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                @error('brand') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-sky-400 mb-2">Kategori</label>
                <select name="category" class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                    @php
                        $categories = ['CPU', 'GPU', 'RAM', 'Motherboard', 'PSU', 'Storage', 'Case', 'Cooler'];
                    @endphp
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $component->category) === $cat ? 'selected' : '' }} class="bg-slate-900">
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Price & Stock -->
            <div>
                <label class="block text-sm font-bold text-sky-400 mb-2"> Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $component->price) }}" step="1000"
                       class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 placeholder-slate-500 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                @error('price') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-sky-400 mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $component->stock) }}"
                       class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 placeholder-slate-500 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                @error('stock') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Specification -->
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-sky-400 mb-2">Spesifikasi</label>
                <textarea name="specification" rows="4"
                          class="w-full bg-slate-800/50 border border-slate-700 text-slate-100 placeholder-slate-500 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">{{ old('specification', $component->specification) }}</textarea>
                @error('specification') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Image Upload -->
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-sky-400 mb-2"> Upload Gambar</label>
                <div class="flex gap-4">
                    @if($component->image)
                        <div class="relative">
                            <img src="{{ $component->image_url }}" alt="{{ $component->name }}" class="h-32 w-32 object-cover rounded-lg border-2 border-sky-500">
                            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">Ada</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="image" accept="image/*"
                               class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-sky-600 file:text-white hover:file:bg-sky-700 cursor-pointer">
                        <p class="text-xs text-slate-500 mt-2">Maks 2MB. Format: JPEG, PNG, JPG, GIF</p>
                        @error('image') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-6">
            <button type="submit" class="flex-1 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white py-3 rounded-lg text-lg font-bold transition shadow-lg">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.products.index') }}" class="flex-1 border border-slate-700 hover:bg-slate-800/50 text-slate-300 py-3 rounded-lg text-lg font-bold text-center transition">
                X Batal
            </a>
        </div>
    </form>

</div>

</body>
</html>
