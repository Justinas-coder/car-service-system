<?php

namespace App\Services;

use App\Models\VehicleModel;

class VehicleModelService
{
    public function getByMake($makeId)
    {
        return VehicleModel::where('vehicle_make_id', $makeId)->get();
    }
}
