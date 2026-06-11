<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $components = Component::where('is_active', true)
                        ->latest()
                        ->take(8)
                        ->get();

        return view('welcome', compact('components'));
    }
}