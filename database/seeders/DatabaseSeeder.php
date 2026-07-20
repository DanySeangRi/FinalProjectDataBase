<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\RouteSchedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        $customer = User::create([
            'first_name' => 'Sokha',
            'last_name' => 'Chenda',
            'email' => 'customer@angkortravel.com',
            'password' => bcrypt('Customer@123'),
            'phone_number' => '012345678',
            'role' => 'user',
        ]);


        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Manager',
            'email' => 'admin@angkortravel.com',
            'password' => bcrypt('admin@angkortravel.com'),
            'phone_number' => '010999888',
            'role' => 'admin',
        ]);



        /*
        |--------------------------------------------------------------------------
        | VEHICLES
        |--------------------------------------------------------------------------
        */


        $vehicles = [

            [
                'vehicle_number' => 'AT-001',
                'brand' => 'Hyundai',
                'plate_number' => 'PP-8888',
                'type' => 'VIP Sleeper',
                'year' => 2024,
                'capacity' => 30,
                'status' => 'active'
            ],

            [
                'vehicle_number' => 'AT-002',
                'brand' => 'Toyota',
                'plate_number' => 'PP-7777',
                'type' => 'Express Bus',
                'year' => 2023,
                'capacity' => 40,
                'status' => 'active'
            ],

            [
                'vehicle_number' => 'AT-003',
                'brand' => 'Mercedes',
                'plate_number' => 'PP-6666',
                'type' => 'Standard Bus',
                'year' => 2022,
                'capacity' => 45,
                'status' => 'active'
            ],

            [
                'vehicle_number' => 'AT-004',
                'brand' => 'Ford',
                'plate_number' => 'PP-5555',
                'type' => 'Express Bus',
                'year' => 2024,
                'capacity' => 35,
                'status' => 'active'
            ],


        ];


        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }


        $bus1 = Vehicle::find(1);
        $bus2 = Vehicle::find(2);
        $bus3 = Vehicle::find(3);
        $bus4 = Vehicle::find(4);



        /*
        |--------------------------------------------------------------------------
        | ROUTES (25 CAMBODIAN PROVINCES)
        |--------------------------------------------------------------------------
        */


        $routes = [

            ['Phnom Penh', 'Siem Reap', 320, 360],
            ['Phnom Penh', 'Battambang', 290, 330],
            ['Phnom Penh', 'Kampot', 150, 180],
            ['Phnom Penh', 'Sihanoukville', 230, 270],
            ['Phnom Penh', 'Kep', 170, 210],
            ['Phnom Penh', 'Kandal', 40, 60],
            ['Phnom Penh', 'Kampong Cham', 125, 150],
            ['Phnom Penh', 'Kampong Thom', 165, 200],
            ['Phnom Penh', 'Pursat', 190, 230],
            ['Phnom Penh', 'Takeo', 85, 100],
            ['Phnom Penh', 'Svay Rieng', 125, 150],
            ['Phnom Penh', 'Prey Veng', 90, 120],
            ['Phnom Penh', 'Kratie', 250, 300],
            ['Phnom Penh', 'Mondulkiri', 380, 450],
            ['Phnom Penh', 'Ratanakiri', 600, 720],
            ['Siem Reap', 'Battambang', 170, 200],
            ['Siem Reap', 'Kampong Thom', 150, 180],
            ['Battambang', 'Pailin', 80, 100],
            ['Kampot', 'Sihanoukville', 110, 140],
            ['Kep', 'Kampot', 30, 45],
            ['Pursat', 'Battambang', 105, 130],
            ['Kratie', 'Stung Treng', 150, 180],
            ['Kampong Cham', 'Kratie', 150, 180],
            ['Takeo', 'Kep', 100, 120],
            ['Siem Reap', 'Preah Vihear', 220, 280],

        ];



        $createdRoutes = [];


        foreach ($routes as $route) {

            $createdRoutes[] = Route::create([

                'origin' => $route[0],
                'destination' => $route[1],
                'distance' => $route[2],
                'duration_minutes' => $route[3],
                'status' => 'active'

            ]);

        }




        /*
        |--------------------------------------------------------------------------
        | SCHEDULES
        |--------------------------------------------------------------------------
        */


        foreach ($createdRoutes as $index => $route) {


            RouteSchedule::create([

                'route_id' => $route->id,

                'vehicle_id' => [
                    $bus1->id,
                    $bus2->id,
                    $bus3->id,
                    $bus4->id
                ][$index % 4],


                'travel_date' => Carbon::now()
                    ->addDays($index % 7)
                    ->format('Y-m-d'),


                'departure_time' => [
                    '06:00:00',
                    '08:30:00',
                    '13:00:00',
                    '18:00:00'
                ][$index % 4],


                'arrival_time' => [
                    '10:00:00',
                    '12:30:00',
                    '17:00:00',
                    '22:00:00'
                ][$index % 4],


                'price' => [
                    10,
                    15,
                    18,
                    25
                ][$index % 4],


                'available_seats' => 40,

            ]);


        }




        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */

        Booking::create([

            'user_id' => $customer->id,

            'route_schedule_id' => 1,

            'first_name' => $customer->first_name,

            'last_name' => $customer->last_name,

            'email' => $customer->email,

            'phone' => $customer->phone_number,

            'booking_code' => 'AT000001',

            'seat_number' => '1A',

            'total_price' => 15,

            'status' => 'confirmed'

        ]);


        Booking::create([

            'user_id' => $customer->id,

            'route_schedule_id' => 2,

            'first_name' => $customer->first_name,

            'last_name' => $customer->last_name,

            'email' => $customer->email,

            'phone' => $customer->phone_number,

            'booking_code' => 'AT000002',

            'seat_number' => '5B',

            'total_price' => 12,

            'status' => 'pending'

        ]);



    }
}