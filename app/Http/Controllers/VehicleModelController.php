<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleModelRequest;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function edit(VehicleModel $model)
    {
        return view('vehicle.models.edit', [
            'model' => $model
        ]);
    }

    public function update(VehicleModel $model, StoreVehicleModelRequest $request)
    {
        $model->update([
            'title' => $request->title,
        ]);

        return redirect()->route('vehicles.edit', $model->vehicle_make_id)
            ->with('success', 'Vehicle model updated successfully!');
    }

    public function destroy(VehicleModel $model)
    {
        $model->delete();

        return redirect()->route('vehicles.edit', $model->vehicle_make_id)
            ->with('success', 'Vehicle model deleted successfully!');
    }
}
