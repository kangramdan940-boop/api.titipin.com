<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders' => Order::count(),
            'processing' => Order::whereNotIn('status', ['delivered', 'cancelled'])->count(),
            'revenue' => Order::where('status', 'delivered')->sum('total'),
            'users' => User::count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard.index', compact('stats', 'recentOrders'));
    }
}
