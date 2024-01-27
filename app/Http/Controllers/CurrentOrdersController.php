<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CurrentOrdersController extends Controller
{
    public function index(Order $order)
    {
        return view('orders.current_orders.index', [
            'order' => $order
        ]);
    }

    public function edit(Order $order)
    {
        return view('orders.current_orders.edit', [
            'order' => $order
        ]);
    }
}
