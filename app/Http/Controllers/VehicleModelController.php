<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleModelRequest;
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

    public function store(VehicleMake $vehicleMake, StoreVehicleModelRequest $request)
    {
        $vehicleMake->models()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.vehicle-make.models.index', $vehicleMake)->with('success', 'Vehicle model added successfully!');
    }
}
