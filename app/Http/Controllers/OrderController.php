<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\VehicleMake;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create', [
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all()); //TODO still in progress
    }
}
