<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceModelService
{
    public static function calculateTotalPrice($services)
    {
        return Service::whereIn('id', $services)->sum('price');
    }
}
