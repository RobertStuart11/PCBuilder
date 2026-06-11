<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = User::where('role', 'seller')->with('components')->latest()->paginate(10);

        return view('admin.sellers.index', compact('sellers'));
    }

    public function show(User $seller)
    {
        if ($seller->role !== 'seller') abort(404);

        $components = $seller->components()->paginate(10);
        $stats = [
            'products'   => $seller->components()->count(),
            'sales'      => $seller->components()->sum('stock'),
            'revenue'    => 0, // Bisa dihitung dari order_details nanti
        ];

        return view('admin.sellers.show', compact('seller', 'components', 'stats'));
    }

    public function toggleActive(User $seller)
    {
        if ($seller->role !== 'seller') abort(404);

        // Bisa tambahkan field 'is_active' di tabel users jika diperlukan
        // Untuk sementara hanya info

        return redirect()->back()->with('success', 'Status seller diperbarui!');
    }
}