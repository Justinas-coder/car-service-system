<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\VehicleMake;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([CarSeeder::class]);

        User::factory()->admin()->create();
        User::factory(10)->create();
        Service::factory(10)->create();
        Invoice::factory(10)->create();
        Order::factory(8)->create();

        foreach (Order::all() as $order) {
            $services = Service::inRandomOrder()->take(rand(1,3))->pluck('id');
            $order->services()->attach($services);
        }

    }
}
