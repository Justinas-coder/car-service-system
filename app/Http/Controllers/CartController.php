<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Order $order)
    {
        return view('cart.show', [
            'order' => $order
        ]);
    }
}
