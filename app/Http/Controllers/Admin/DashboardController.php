<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Component;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers      = User::count();
        $totalSeller     = User::where('role', 'seller')->count();
        $totalBuyer      = User::where('role', 'buyer')->count();
        $totalComponents = Component::count();
        $totalOrders     = Order::count();
        $recentOrders    = Order::with('buyer')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalSeller', 'totalBuyer',
            'totalComponents', 'totalOrders', 'recentOrders'
        ));
    }
}