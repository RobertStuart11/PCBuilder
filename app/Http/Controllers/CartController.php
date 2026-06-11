<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Traits\ChecksComponentCompatibility;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ChecksComponentCompatibility;
    public function index()
    {
        $cart = session('cart', []);
        $cartItems = [];
        $totalPrice = 0;

        foreach ($cart as $componentId => $quantity) {
            $component = Component::find($componentId);
            if ($component) {
                $subtotal = $component->price * $quantity;
                $cartItems[] = [
                    'component' => $component,
                    'quantity'  => $quantity,
                    'subtotal'  => $subtotal,
                ];
                $totalPrice += $subtotal;
            }
        }

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Component $component, Request $request)
    {
        $quantity = (int) $request->input('quantity', 1);

        if ($component->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        $cart = session('cart', []);

        if (isset($cart[$component->id])) {
            $cart[$component->id] += $quantity;
        } else {
            $cart[$component->id] = $quantity;
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'component_id' => 'required|exists:components,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $component = Component::findOrFail($validated['component_id']);

        if ($component->stock < $validated['quantity']) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk komponen ini.');
        }

        $cart = session('cart', []);
        $componentId = $component->id;

        if (isset($cart[$componentId])) {
            $cart[$componentId] += $validated['quantity'];
        } else {
            $cart[$componentId] = $validated['quantity'];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Komponen ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $quantities = $request->input('quantities', []);

        foreach ($quantities as $componentId => $quantity) {
            $quantity = max(1, (int) $quantity);
            $component = Component::find($componentId);

            if ($component && $component->stock >= $quantity) {
                $cart[$componentId] = $quantity;
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui!');
    }

    public function remove(Component $component)
    {
        $cart = session('cart', []);
        unset($cart[$component->id]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Transfer cart ke pc_build_components untuk checkout
        session(['pc_build_components' => array_keys($cart)]);

        return redirect()->route('checkout.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan!');
    }
    public function checkCompatibility(Request $request)
    {
        $cart = session('cart', []);
        $selectedIds = array_keys($cart);

        if (count($selectedIds) < 2) {
            return response()->json([
                'compatible' => true,
                'issues'     => [],
                'message'    => 'Pilih minimal 2 komponen untuk cek kompatibilitas.',
            ]);
        }

        $issues = [];
        $components = Component::whereIn('id', $selectedIds)->get()->keyBy('id');

        // Loop semua kombinasi komponen
        for ($i = 0; $i < count($selectedIds); $i++) {
            for ($j = $i + 1; $j < count($selectedIds); $j++) {
                $id1 = $selectedIds[$i];
                $id2 = $selectedIds[$j];

                $comp1 = $components[$id1];
                $comp2 = $components[$id2];

                // Cek di database rules terlebih dahulu
                $rule = \App\Models\CompatibilityRule::where(function ($q) use ($id1, $id2) {
                    $q->where('component_id_1', $id1)->where('component_id_2', $id2);
                })->orWhere(function ($q) use ($id1, $id2) {
                    $q->where('component_id_1', $id2)->where('component_id_2', $id1);
                })->first();

                // Jika ada rule explicit, gunakan rule tersebut
                if ($rule) {
                    if (!$rule->is_compatible) {
                        $issues[] = [
                            'type'        => 'error',
                            'component_1' => $comp1->name,
                            'component_2' => $comp2->name,
                            'message'     => $rule->description ?? 'Komponen tidak kompatibel.',
                        ];
                    }
                } else {
                    // Jika tidak ada rule, lakukan pengecekan otomatis berdasarkan spesifikasi
                    $incompatibilityIssue = $this->checkSpecificationCompatibility($comp1, $comp2);
                    if ($incompatibilityIssue) {
                        $issues[] = [
                            'type'        => 'error',
                            'component_1' => $comp1->name,
                            'component_2' => $comp2->name,
                            'message'     => $incompatibilityIssue,
                        ];
                    }
                }
            }
        }

        return response()->json([
            'compatible' => empty($issues),
            'issues'     => $issues,
            'message'    => empty($issues)
                ? 'Semua komponen di keranjang kompatibel!'
                : 'Ditemukan ' . count($issues) . ' masalah kompatibilitas.',
        ]);
    }
}
