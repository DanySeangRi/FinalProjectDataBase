<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();


            // Logged user (optional)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();



            // Trip information
            $table->foreignId('route_schedule_id')
                ->constrained()
                ->cascadeOnDelete();



            // Passenger information
            $table->string('first_name');

            $table->string('last_name');

            $table->string('email');

            $table->string('phone');



            // Booking information
            $table->string('booking_code')
                ->unique();


            $table->string('seat_number');


            $table->decimal('total_price', 10, 2);



            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled'
            ])
            ->default('pending');


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};