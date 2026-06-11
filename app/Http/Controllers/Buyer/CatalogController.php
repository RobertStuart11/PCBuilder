<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private array $categories = [
        'CPU', 'GPU', 'RAM', 'Motherboard', 'PSU', 'Storage', 'Case', 'Cooler'
    ];

    public function index(Request $request)
    {
        $query = Component::with('seller')->where('is_active', true);

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        match ($request->get('sort', 'terbaru')) {
            'termurah'  => $query->orderBy('price', 'asc'),
            'termahal'  => $query->orderBy('price', 'desc'),
            default     => $query->latest(),
        };

        $components = $query->paginate(12)->withQueryString();
        $categories = $this->categories;

        return view('buyer.catalog', compact('components', 'categories'));
    }

    public function show(Component $component)
    {
        if (!$component->is_active) abort(404);

        // Ambil aturan kompatibilitas komponen ini
        $rules = $component->compatibilityAsFirst()
                    ->with('componentTwo')
                    ->get()
                    ->merge(
                        $component->compatibilityAsSecond()->with('componentOne')->get()
                    );

        // Produk sejenis lainnya
        $related = Component::where('category', $component->category)
                    ->where('id', '!=', $component->id)
                    ->where('is_active', true)
                    ->take(4)->get();

        return view('buyer.component-detail', compact('component', 'rules', 'related'));
    }
}