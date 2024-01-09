<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        return view('orders.create', [
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function show(Request $request)
    {
        dd($request->all());
    }
}
