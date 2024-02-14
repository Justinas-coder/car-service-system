<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleModelResource;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Services\VehicleModelService;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    protected VehicleModelService $vehicleModelService;

    public function __construct(VehicleModelService $vehicleModelService)
    {
        $this->vehicleModelService = $vehicleModelService;
    }

    public function index(VehicleMake $make)
    {
        $vehicleModels = $this->vehicleModelService->getByMake($make->id);

        return VehicleModelResource::collection($vehicleModels);
    }

    public function store(Request $request, VehicleMake $make)
    {
        $newModel = $make->models()->create([
            'title' => $request->title,
        ]);

        return new VehicleModelResource($newModel);
    }
}
