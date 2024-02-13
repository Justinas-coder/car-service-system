<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleMakeRequest;
use App\Models\Order;
use App\Models\Service;
use App\Models\VehicleMake;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    public function index()
    {
        return view('vehicles.index', [
            'vehicleMakes' => VehicleMake::all(),
        ]);
    }

    public function create()
    {
        return view('admin.vehicle_makes.create');
    }

    public function store(StoreVehicleMakeRequest $request)
    {
        VehicleMake::create([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.vehicle-makes.index')
            ->with('success', 'Vehicle make added successfully!');
    }

    public function edit(VehicleMake $vehicleMake)
    {
        return view('vehicles.edit', [
            'vehicleMake' => $vehicleMake
        ]);
    }

    public function update(VehicleMake $make, StoreVehicleMakeRequest $request)
    {
        $make->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.vehicle-makes.index')
            ->with('success', "Vehicle make  {$make->title} updated successfully!");
    }

    public function destroy(VehicleMake $make)
    {
        $make->delete();

        return redirect()->route('vehicles.index')
            ->with('success', "Vehicle make  {$make->title} deleted successfully!");
    }
}
