<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicles;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicles::create([
            'vehicleName' => 'VIP Express 44',
            'vehicleType' => 'VIP Bus',
            'plateNum' => 'PP-1044',
            'capacity' => 45,
            'ammenities' => 'WiFi, USB, A/C',
            'brand' => 'Hyundai',
            'status' => 'active',
            'photo' => null,
            'yearAdded' => 2022,

        ]);

         Vehicles::create([
            'vehicleName' => 'Night Rider 38',
            'vehicleType' => 'Sleeper Bus',
            'plateNum' => 'PP-2038',
            'capacity' => 38,
            'ammenities' => 'WiFi, USB, A/C',
            'brand' => 'Hyundai',
            'status' => 'active',
            'photo' => null,
            'yearAdded' => 2023,
        ]);

        Vehicles::create([
            'vehicleName' => 'VIP Express 52',
            'vehicleType' => 'VIP Bus',
            'plateNum' => 'PP-3052',
            'capacity' => 52,
            'ammenities' => 'WiFi, USB, A/C',
            'brand' => 'Toyota',
            'status' => 'active',
            'photo' => null,
            'yearAdded' => 2021,
        ]);

    }
}
