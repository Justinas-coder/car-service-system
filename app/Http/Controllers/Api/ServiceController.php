<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\VehicleModelResource;
use App\Models\Service;
use App\Models\VehicleMake;
use App\Services\ServiceService;
use App\Services\VehicleModelService;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function show(Service $service)
    {
        $service = $this->serviceService->getServiceById($service->id);

        return new ServiceResource($service);
    }
}
