<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleMakeResource;
use App\Http\Resources\VehicleModelResource;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Services\VehicleModelService;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    public function store(Request $request, VehicleMake $make)
    {
        $newMake = $make->create([
            'title' => $request->title,
        ]);

        return new VehicleMakeResource($newMake);
    }
}
