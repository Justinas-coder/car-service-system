<?php

namespace Database\Seeders;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            'Volkswagen' => ['Golf', 'Jetta', 'Passat', 'Tiguan', 'Atlas'],
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Prius', 'Highlander'],
            'Mercedes Benz' => ['C-Class', 'E-Class', 'S-Class', 'GLC', 'GLE'],
            'Ford' => ['F-150', 'Mustang', 'Explorer', 'Escape', 'Focus'],
            'General Motors' => [
                'Chevrolet Silverado', 'GMC Sierra', 'Cadillac Escalade', 'Buick Enclave', 'Chevrolet Malibu'
            ],
            'Honda' => ['Accord', 'Civic', 'CR-V', 'Pilot', 'Odyssey'],
            'Hyundai' => ['Sonata', 'Elantra', 'Santa Fe', 'Tucson', 'Kona'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', '7 Series'],
            'Nissan' => ['Altima', 'Rogue', 'Sentra', 'Pathfinder', 'Titan'],
            'Tesla' => ['VehicleModel S', 'VehicleModel 3', 'VehicleModel X', 'VehicleModel Y', 'Cybertruck'],
        ];

        foreach ($cars as $makeName => $models) {
            $make = VehicleMake::create([
                'title' => $makeName,
            ]);

            foreach ($models as $modelName) {
                $make->models()->create([
                    'title' => $modelName,
                ]);
            }
        }
    }
}
