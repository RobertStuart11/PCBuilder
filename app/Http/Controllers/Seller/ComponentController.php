<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentController extends Controller
{
    private array $categories = [
        'CPU', 'GPU', 'RAM', 'Motherboard', 'PSU', 'Storage', 'Case', 'Cooler'
    ];

    public function index()
    {
        $components = Component::where('user_id', auth()->id())
                        ->latest()->paginate(10);

        return view('seller.components.index', compact('components'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('seller.components.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:100',
            'category'    => 'required|in:' . implode(',', $this->categories),
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('components', 'public');
        }

        $validated['user_id']   = auth()->id();
        $validated['is_active'] = true;

        Component::create($validated);

        return redirect()->route('seller.components.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Component $component)
    {
        $this->authorizeComponent($component);
        return view('seller.components.show', compact('component'));
    }

    public function edit(Component $component)
    {
        $this->authorizeComponent($component);
        $categories = $this->categories;
        return view('seller.components.edit', compact('component', 'categories'));
    }

    public function update(Request $request, Component $component)
    {
        $this->authorizeComponent($component);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:100',
            'category'    => 'required|in:' . implode(',', $this->categories),
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($component->image) {
                Storage::disk('public')->delete($component->image);
            }
            $validated['image'] = $request->file('image')->store('components', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $component->update($validated);

        return redirect()->route('seller.components.index')
                         ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Component $component)
    {
        $this->authorizeComponent($component);

        if ($component->image) {
            Storage::disk('public')->delete($component->image);
        }

        $component->delete();

        return redirect()->route('seller.components.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }

    private function authorizeComponent(Component $component): void
    {
        if ($component->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }
    }
}