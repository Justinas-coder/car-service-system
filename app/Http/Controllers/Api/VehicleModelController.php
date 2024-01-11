<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleModelResource;
use App\Models\VehicleMake;
use App\Services\VehicleModelService;

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
}
