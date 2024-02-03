<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function getServiceById(int $serviceId): ?Service
    {
        return Service::find($serviceId);
    }
}
