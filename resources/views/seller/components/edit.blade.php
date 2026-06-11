<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder - Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <a href="{{ route('seller.dashboard') }}" class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-20">
    </a>
    <a href="{{ route('seller.components.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Kembali ke Produk</a>
</nav>

<div class="max-w-2xl mx-auto mt-8 px-4 pb-16">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Produk</h1>

    <form method="POST" action="{{ route('seller.components.update', $component) }}" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow p-8 space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $component->name) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Brand <span class="text-red-500">*</span></label>
                <input type="text" name="brand" value="{{ old('brand', $component->brand) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $component->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="price" value="{{ old('price', $component->price) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stok <span class="text-red-500">*</span></label>
                <input type="number" name="stock" value="{{ old('stock', $component->stock) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $component->description) }}</textarea>
        </div>

        {{-- Gambar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Gambar Produk</label>
            
            @if($component->image)
                <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-xs text-blue-600 font-semibold mb-2">Gambar Saat Ini:</p>
                    <img src="{{ $component->image_url }}" alt="{{ $component->name }}"
                         class="h-32 w-32 object-cover rounded-lg border-2 border-blue-500">
                </div>
            @endif

            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition" id="dropZone">
                <input type="file" name="image" accept="image/*" id="imageInput" class="hidden">
                <div id="uploadPrompt">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-12l-3.172-3.172a4 4 0 00-5.656 0L28 12M28 12l-4-4m0 0l-3.172 3.172a4 4 0 00-.828 5.656" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    @if($component->image)
                        <p class="text-sm text-gray-600 mb-1"><span class="font-semibold text-blue-600 cursor-pointer">Klik untuk upload</span> gambar baru</p>
                    @else
                        <p class="text-sm text-gray-600 mb-1"><span class="font-semibold text-blue-600 cursor-pointer">Klik untuk upload</span> atau drag & drop</p>
                    @endif
                    <p class="text-xs text-gray-500">JPG, PNG, WEBP - Maks 2MB</p>
                </div>
                <img id="imagePreview" class="hidden mx-auto h-32 w-32 object-cover rounded-lg border-2 border-blue-500">
            </div>
            <p id="fileName" class="text-xs text-gray-500 mt-2 text-center"></p>
            @error('image')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
        </div>

        <script>
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const fileName = document.getElementById('fileName');

        dropZone.addEventListener('click', () => imageInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            const files = e.dataTransfer.files;
            if (files.length) imageInput.files = files;
            handleImageSelect();
        });

        imageInput.addEventListener('change', handleImageSelect);

        function handleImageSelect() {
            const file = imageInput.files[0];
            if (file) {
                fileName.textContent = 'File dipilih: ' + file.name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
        </script>

        {{-- Status aktif --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $component->is_active) ? 'checked' : '' }}
                   class="w-4 h-4 text-blue-600">
            <label for="is_active" class="text-sm text-gray-700">Produk aktif (tampil di katalog)</label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                Update Produk
            </button>
            <a href="{{ route('seller.components.index') }}"
               class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-lg transition">
                Batal
            </a>
        </div>
    </form>
</div>

</body>
</html>