<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Component;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $componentIds = session('pc_build_components', []);

        if (empty($componentIds)) {
            return redirect()->route('pcbuilder')->with('error', 'Build PC tidak ditemukan.');
        }

        $components = Component::whereIn('id', $componentIds)->get();

        if ($components->isEmpty()) {
            return redirect()->route('pcbuilder')->with('error', 'Komponen tidak ditemukan.');
        }

        $totalPrice = $components->sum('price');
        $user       = auth()->user();

        return view('checkout.index', compact('components', 'totalPrice', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|min:10',
            'phone'            => 'required|string|min:10',
        ]);

        $componentIds = session('pc_build_components', []);

        if (empty($componentIds)) {
            return redirect()->route('pcbuilder')->with('error', 'Build PC tidak ditemukan.');
        }

        $components = Component::whereIn('id', $componentIds)->get();
        $totalPrice = $components->sum('price');

        // Buat order
        $order = Order::create([
            'user_id'           => auth()->id(),
            'status'            => 'pending',
            'total_price'       => $totalPrice,
            'shipping_address'  => $validated['shipping_address'],
            'payment_method'    => $request->input('payment_method', 'transfer'),
            'payment_status'    => 'unpaid',
        ]);

        // Buat order details
        foreach ($components as $component) {
            OrderDetail::create([
                'order_id'       => $order->id,
                'component_id'   => $component->id,
                'quantity'       => 1,
                'price_per_item' => $component->price,
                'subtotal'       => $component->price,
            ]);
        }

        // Simpan order ID di session
        session(['current_order_id' => $order->id]);

        return redirect()->route('checkout.payment', $order->id);
    }

    public function payment(Order $order)
    {
        // Pastikan order milik user yang login
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Jika sudah dibayar, redirect ke success
        if ($order->isPaid()) {
            return redirect()->route('checkout.success', $order->id);
        }

        return view('checkout.payment', compact('order'));
    }

    public function processPayment(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Simulasi: setiap pembayaran berhasil (untuk testing)
        // Di production, ganti dengan gateway pembayaran asli
        $order->update([
            'status'         => 'paid',
            'payment_status' => 'paid',
        ]);

        // Clear session
        session()->forget(['pc_build_components', 'pc_build_total', 'current_order_id']);

        return redirect()->route('checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}