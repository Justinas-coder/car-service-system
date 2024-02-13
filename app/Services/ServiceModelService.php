<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceModelService
{
    public static function calculateTotalPrice($services)
    {
        $serviceIds = array_map('intval', $services);

        return Service::whereIn('id', $serviceIds)->sum('price');
    }
}
