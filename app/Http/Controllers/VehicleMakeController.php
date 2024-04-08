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
        return view('vehicle.index', [
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

    public function edit(VehicleMake $vehicle)
    {

        return view('vehicle.edit', [
            'vehicleMake' => $vehicle
        ]);
    }

    public function update(VehicleMake $vehicle, StoreVehicleMakeRequest $request)
    {
        $vehicle->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.vehicle-makes.index')
            ->with('success', "Vehicle make  {$vehicle->title} updated successfully!");
    }

    public function destroy(VehicleMake $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', "Vehicle make  {$vehicle->title} deleted successfully!");
    }
}
