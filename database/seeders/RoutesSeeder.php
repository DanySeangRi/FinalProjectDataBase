<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Routes;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Routes::create([
         'departPlace'=> 'Phnom Penh',
         'arrivePlace' => 'Siem Reap',
         'distance' => 315,
         'status' => 'active',
         'boardStation' => 'Central Station',
         'dropOffStation' => 'Siem Reap Bus Terminal',
        ]);

       Routes::create([
         'departPlace'=> 'Siem Reap',
         'arrivePlace' => 'Phnom Penh',
         'distance' => 315,
         'status' => 'active',
         'boardStation' => 'Siem Reap Bus Terminal',
         'dropOffStation' => 'Central Station',
        ]);

       Routes::create([
        'departPlace' => 'Phnom Penh',
        'arrivePlace' => 'Battambang',
        'distance' => 290.00,
        'status' => 'active',
        'boardStation' => 'Central Station',
        'dropOffStation' => 'Battambang Bus Stop',
       ]);

      Routes::create([
        'departPlace' => 'Battambang',
        'arrivePlace' => 'Phnom Penh',
        'distance' => 290.00,
        'status' => 'active',
        'boardStation' => 'Battambang Bus Stop',
        'dropOffStation' => 'Central Station',
       ]);
    }
}
