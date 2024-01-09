<?php

namespace App\Http\Controllers;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    public function index()
    {
        $vehicleMakes = VehicleMake::all();
        return response()->json($vehicleMakes);
    }
}
