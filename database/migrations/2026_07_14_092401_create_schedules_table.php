<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_schedule', function (Blueprint $table) {
            $table->id('scheduleID');
            $table->foreignId('routeID')->constrained('tbl_routes','routeID')->onDelete('cascade');
            $table->foreignId('vehicleID')->constrained('tbl_vehicles','vehicleID')->onDelete('cascade');
            $table->date('departDate');
            $table->date('arrivalDate');
            $table->time('departTime');
            $table->time('arrivalTime'); 
            $table->time('duration'); 
            $table->decimal('price',8,2);
            $table->unsignedInteger('availableSeat');
            $table->enum('status',['active','inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
