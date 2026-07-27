<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('route_schedules', function (Blueprint $table) {

            $table->id();

            $table->foreignId('route_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('vehicle_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('travel_date');

            $table->time('departure_time');

            $table->time('arrival_time');

            // Duration of this specific trip
            $table->integer('duration_minutes')->nullable();

            $table->decimal('price', 10, 2);

            $table->enum('status', [
                'active',
                'completed',
                'cancelled'
            ])->default('active');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('route_schedules');
    }
};