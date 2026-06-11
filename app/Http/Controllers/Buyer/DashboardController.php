<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $recentOrders = Order::where('user_id', auth()->id())
                            ->latest()->take(5)->get();
        $totalOrders  = Order::where('user_id', auth()->id())->count();

        return view('buyer.dashboard', compact('recentOrders', 'totalOrders'));
    }
}