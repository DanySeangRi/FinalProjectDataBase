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
use App\Models\Seat;

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
            'password' => Hash::make('Customer@123'),
            'phone_number' => '012345678',
            'role' => 'user',
        ]);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Manager',
            'email' => 'admin@angkortravel.com',
            'password' => Hash::make('Admin@123'),
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
        | ROUTES (Removed duration column from array)
        |--------------------------------------------------------------------------
        */

        $routes = [
            ['Phnom Penh', 'Siem Reap', 320],
            ['Phnom Penh', 'Battambang', 290],
            ['Phnom Penh', 'Kampot', 150],
            ['Phnom Penh', 'Sihanoukville', 230],
            ['Phnom Penh', 'Kep', 170],
            ['Phnom Penh', 'Kandal', 40],
            ['Phnom Penh', 'Kampong Cham', 125],
            ['Phnom Penh', 'Kampong Thom', 165],
            ['Phnom Penh', 'Pursat', 190],
            ['Phnom Penh', 'Takeo', 85],
            ['Phnom Penh', 'Svay Rieng', 125],
            ['Phnom Penh', 'Prey Veng', 90],
            ['Phnom Penh', 'Kratie', 250],
            ['Phnom Penh', 'Mondulkiri', 380],
            ['Phnom Penh', 'Ratanakiri', 600],
            ['Siem Reap', 'Battambang', 170],
            ['Siem Reap', 'Kampong Thom', 150],
            ['Battambang', 'Pailin', 80],
            ['Kampot', 'Sihanoukville', 110],
            ['Kep', 'Kampot', 30],
            ['Pursat', 'Battambang', 105],
            ['Kratie', 'Stung Treng', 150],
            ['Kampong Cham', 'Kratie', 150],
            ['Takeo', 'Kep', 100],
            ['Siem Reap', 'Preah Vihear', 220],
        ];

        $createdRoutes = [];

        foreach ($routes as $route) {
            $createdRoutes[] = Route::create([
                'origin' => $route[0],
                'destination' => $route[1],
                'distance' => $route[2],
                'status' => 'active'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SCHEDULES + SEATS (Added duration here)
        |--------------------------------------------------------------------------
        */

        $createdSchedules = [];

        foreach ($createdRoutes as $index => $route) {

            $schedule = RouteSchedule::create([
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

                // ----------------------------------------------------
                // ADDED DURATION TO SCHEDULE HERE:
                // ----------------------------------------------------
                'duration' => [
                    '4 hours',
                    '4 hours 30 min',
                    '5 hours',
                    '6 hours'
                ][$index % 4],

                'price' => [
                    10,
                    15,
                    18,
                    25
                ][$index % 4],

                'status' => 'active',
            ]);

            $createdSchedules[] = $schedule;


            /*
            |--------------------------------------------------------------------------
            | Generate Seats
            |--------------------------------------------------------------------------
            */

            $vehicle = $schedule->vehicle;
            $capacity = $vehicle->capacity;
            $letters = ['A', 'B', 'C', 'D'];
            $seatCount = 0;

            for ($row = 1; $seatCount < $capacity; $row++) {
                foreach ($letters as $letter) {
                    if ($seatCount >= $capacity) {
                        break;
                    }

                    Seat::create([
                        'schedule_id' => $schedule->id,
                        'seat_number' => $row . $letter,
                        'status' => 'available'
                    ]);

                    $seatCount++;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */

        $booking1 = Booking::create([
            'user_id' => $customer->id,
            'route_schedule_id' => $createdSchedules[0]->id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'phone' => $customer->phone_number,
            'booking_code' => 'AT000001',
            'total_price' => 20,
            'status' => 'confirmed'
        ]);

        $seat1 = Seat::where('schedule_id', $createdSchedules[0]->id)
            ->where('seat_number', '1A')
            ->first();

        $seat2 = Seat::where('schedule_id', $createdSchedules[0]->id)
            ->where('seat_number', '1B')
            ->first();

        $booking1->seats()->attach([
            $seat1->id,
            $seat2->id
        ]);

        $seat1->update(['status' => 'booked']);
        $seat2->update(['status' => 'booked']);


        $booking2 = Booking::create([
            'user_id' => $customer->id,
            'route_schedule_id' => $createdSchedules[1]->id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'phone' => $customer->phone_number,
            'booking_code' => 'AT000002',
            'total_price' => 15,
            'status' => 'pending'
        ]);

        $seat3 = Seat::where('schedule_id', $createdSchedules[1]->id)
            ->where('seat_number', '5B')
            ->first();

        $booking2->seats()->attach($seat3->id);
        $seat3->update(['status' => 'booked']);
    }
}