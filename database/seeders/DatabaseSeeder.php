<?php
namespace Database\Seeders;



use Illuminate\Database\Seeder;

use App\Models\User;

use App\Models\Vehicle;

use App\Models\Route;

use App\Models\RouteSchedule;

use App\Models\Booking;

use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        // Users
        $customer = User::create([
            'first_name' => 'Kimseang',
            'last_name' => 'dany',
            'email' => 'kimseang@gmail.com',
            'password' =>  bcrypt('12345678'),
             'phone_number' => '1234567890',
            'role' => 'user',
        ]);

        $admin = User::create([
            'first_name' => 'John',

            'last_name' => 'Doe',

            'email' => 'johndoe@example.com',

            'password' => bcrypt('12345678'),

            'phone_number' => '1234567890',

            'role' => 'admin',
        ]);




        // Vehicles

        $bus1 = Vehicle::create([

            'vehicle_number' => 'PP-001',

            'type' => 'Bus',

            'capacity' => 40,

            'driver_name' => 'Dara Sok',

            'status' => 'active',

        ]);



        $bus2 = Vehicle::create([

            'vehicle_number' => 'PP-002',

            'type' => 'Mini Bus',

            'capacity' => 25,

            'driver_name' => 'Sokha Lim',

            'status' => 'active',

        ]);





        // Routes

        $siemReap = Route::create([

            'origin' => 'Phnom Penh',

            'destination' => 'Siem Reap',

            'distance' => 320,

            'duration' => '6 hours',

        ]);



        $battambang = Route::create([

            'origin' => 'Phnom Penh',

            'destination' => 'Battambang',

            'distance' => 290,

            'duration' => '5 hours',

        ]);





        // Route schedules

        $schedule1 = RouteSchedule::create([

            'route_id' => $siemReap->id,

            'vehicle_id' => $bus1->id,

            'travel_date' => '2026-07-20',

            'departure_time' => '08:00:00',

            'arrival_time' => '14:00:00',

            'price' => 15.00,

            'available_seats' => 40,

        ]);



        $schedule2 = RouteSchedule::create([

            'route_id' => $battambang->id,

            'vehicle_id' => $bus2->id,

            'travel_date' => '2026-07-20',

            'departure_time' => '09:00:00',

            'arrival_time' => '14:00:00',

            'price' => 12.00,

            'available_seats' => 25,

        ]);





        // Bookings

        Booking::create([

            'user_id' => $customer->id,

            'route_schedule_id' => $schedule1->id,

            'booking_code' => 'ANG001',

            'seat_number' => 'A12',

            'total_price' => 15.00,

            'status' => 'confirmed',

        ]);



        Booking::create([

            'user_id' => $customer->id,

            'route_schedule_id' => $schedule2->id,

            'booking_code' => 'ANG002',

            'seat_number' => 'B05',

            'total_price' => 12.00,

            'status' => 'pending',

        ]);

    }

}