<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $fecha = $request->get('fecha', Carbon::today()->toDateString());

        $orders = Order::with(['customer', 'order_items'])
            ->whereDate('created_at', $fecha)
            ->orderByDesc('created_at')
            ->get();

        $totalVentas = $orders->sum('total_price');

        return view('dashboard', compact('orders', 'fecha', 'totalVentas'));
    }
}


