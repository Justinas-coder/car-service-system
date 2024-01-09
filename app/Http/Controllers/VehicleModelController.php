<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function show($make)
    {
        $vehicleModels = VehicleModel::where('vehicle_make_id', $make)->get();
        return response()->json($vehicleModels);
    }
}
