<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $components = Component::paginate(10);
        return view('admin.products.index', compact('components'));
    }

    public function edit(Component $component)
    {
        return view('admin.products.edit', compact('component'));
    }

    public function update(Request $request, Component $component)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'specification' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($component->image) {
                Storage::delete($component->image);
            }
            
            // Store new image
            $validated['image'] = $request->file('image')->store('components', 'public');
        }

        $component->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Component $component)
    {
        if ($component->image) {
            Storage::delete($component->image);
        }

        $component->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
