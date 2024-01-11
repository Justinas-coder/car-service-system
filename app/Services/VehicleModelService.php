<?php

namespace App\Services;

use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;

class VehicleModelService
{
    public function getByMake(int $makeId): Collection
    {
        return VehicleModel::query()->where('vehicle_make_id', $makeId)->get();
    }
}
