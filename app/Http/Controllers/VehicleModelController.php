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

    public function edit(VehicleModel $model)
    {
        return view('admin.vehicle_models.edit', [
            'model' => $model
        ]);
    }

    public function store(VehicleMake $vehicleMake, StoreVehicleModelRequest $request)
    {
        $vehicleMake->models()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.vehicle-makes.models.index', $vehicleMake)->with('success', 'Vehicle model added successfully!');
    }

    public function update(VehicleModel $model, StoreVehicleModelRequest $request)
    {
        $model->update([
            'title' => $request->title,
        ]);

//        $vehicleMake = $model->make()->id;

        return redirect()->route('admin.vehicle-makes.models.index', $vehicleMake)
            ->with('success', 'Vehicle model updated successfully!');    }


}
