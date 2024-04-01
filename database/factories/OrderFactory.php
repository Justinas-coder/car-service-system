<?php

namespace Database\Factories;

use App\Enums\EnumTrait;
use App\Enums\OrderStatus;
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
        $vehicleMake = VehicleMake::factory()->createOne();
        $vehicleModel = VehicleModel::factory()->for($vehicleMake, 'make')->createOne();

        return [
            'vehicle_make_id' => $vehicleMake->id,
            'vehicle_model_id' => $vehicleModel->id,
            'year' => fake()->year,
            'total_price' => fake()->randomFloat(2, 20, 200),
            'status' => OrderStatus::randomEnum()
        ];
    }
}
