<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function createOrder($userId, $makeId, $modelId, $year, $services)
    {
        $totalPrice = (new ServiceModelService())->calculateTotalPrice($services);

        $order = Order::create([
            'user_id' => $userId,
            'vehicle_make_id' => $makeId,
            'vehicle_model_id' => $modelId,
            'year' => $year,
            'status' => OrderStatus::NOT_PAID,
            'total_price' => $totalPrice,
            'total_tax' => $totalPrice * 0.21
        ]);

        foreach ($services as $service) {
            $order->services()->attach($service);
        }

        return $order;
    }
}
