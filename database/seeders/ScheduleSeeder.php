<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Schedule::create([
            'routeID' => 1,      
            'vehicleID' => 1,     
            'departDate' => '2026-07-15',
            'arrivalDate' => '2026-07-15',
            'departTime' => '06:00:00',
            'arrivalTime' => '11:30:00',
            'duration' => '05:30:00',
            'price' => 12.00,
            'availableSeat' => 8,
            'status' => 'active',
        ]);

          Schedule::create([
            'routeID' => 1,
            'vehicleID' => 2,
            'departDate' => '2026-07-15',
            'arrivalDate' => '2026-07-16',
            'departTime' => '18:30:00',
            'arrivalTime' => '00:00:00',
            'duration' => '05:30:00',
            'price' => 10.00,
            'availableSeat' => 14,
            'status' => 'active',
        ]);

        Schedule::create([
            'routeID' => 1,
            'vehicleID' => 3,
            'departDate' => '2026-07-15',
            'arrivalDate' => '2026-07-15',
            'departTime' => '09:00:00',
            'arrivalTime' => '14:30:00',
            'duration' => '05:30:00',
            'price' => 8.00,
            'availableSeat' => 0,
            'status' => 'active',
        ]);




    }
}
