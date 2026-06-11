<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\Order;
use App\Models\OrderDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $myComponents  = Component::where('user_id', auth()->id())->count();
        $myProductIds  = Component::where('user_id', auth()->id())->pluck('id');
        $totalTerjual  = OrderDetail::whereIn('component_id', $myProductIds)->sum('quantity');
        $totalPendapatan = OrderDetail::whereIn('component_id', $myProductIds)->sum('subtotal');

        return view('seller.dashboard', compact('myComponents', 'totalTerjual', 'totalPendapatan'));
    }
}