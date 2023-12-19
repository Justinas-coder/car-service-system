<?php

namespace Database\Factories;

use App\Enums\EnumTrait;
use App\Enums\OrderStatus;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    use EnumTrait;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'vehicle_make_id' => VehicleMake::inRandomOrder()->value('id'),
            'vehicle_model_id' => VehicleModel::inRandomOrder()->value('id'),
            'year' => fake()->year,
            'service_id' => Service::factory(),
            'total_price' => fake()->randomFloat(2, 20, 200),
            'status' => OrderStatus::randomEnum()
        ];
    }
}
