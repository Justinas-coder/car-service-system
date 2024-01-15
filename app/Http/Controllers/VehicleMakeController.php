<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleMakeRequest;
use App\Models\VehicleMake;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    public function index()
    {
        return view('admin.vehicle_makes.index',[
            'vehicleMakes' => VehicleMake::all(),
        ]);
    }

    public function create()
    {
        return view('admin.vehicle_makes.create');
    }

    public function store(StoreVehicleMakeRequest $request)
    {
        $vehicleMake = new VehicleMake([
            'title' => $request->title,
        ]);

        $vehicleMake->save();

        return redirect()->route('admin.vehicle-make.index')->with('success', 'Vehicle make added successfully!');
    }
}
