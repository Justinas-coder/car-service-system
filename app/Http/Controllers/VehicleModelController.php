<?php

namespace App\Http\Controllers;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function index(VehicleMake $vehicleMake)
    {
        return view('admin.vehicle_models.index',[
            'make' => $vehicleMake,
            'vehicle_models' => $vehicleMake->models()->get(),
        ]);
    }

    public function create(VehicleMake $vehicleMake)
    {
        return view('admin.vehicle_models.create',[
            'make' => $vehicleMake
        ]);
    }
}
