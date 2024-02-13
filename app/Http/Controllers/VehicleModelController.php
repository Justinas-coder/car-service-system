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
        return view('admin.vehicle_models.index', [
            'make' => $vehicleMake,
            'vehicle_models' => $vehicleMake->models()->get()->all(),
        ]);
    }

    public function create(VehicleMake $vehicleMake)
    {
        return view('admin.vehicle_models.create', [
            'make' => $vehicleMake
        ]);
    }

    public function edit(VehicleModel $vehicleModel)
    {
        return view('vehicles.models.edit', [
            'model' => $vehicleModel
        ]);
    }

    public function update(VehicleModel $vehicleModel, StoreVehicleModelRequest $request)
    {
        $vehicleModel->update([
            'title' => $request->title,
        ]);

        return redirect()->route('vehicles.edit', $vehicleModel->vehicle_make_id)
            ->with('success', 'Vehicle model updated successfully!');
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();

        return redirect()->route('vehicles.edit', $vehicleModel->vehicle_make_id)
            ->with('success', 'Vehicle model deleted successfully!');

    }


}
