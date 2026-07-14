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
        Schema::create('tbl_vehicles', function (Blueprint $table) {
            $table->id('vehicleID');
            $table->string('vehicleName', 30);
            $table->string('vehicleType', 20);
            $table->string('plateNum', 15);
            $table->unsignedInteger('capacity');
            $table->text('ammenities');
            $table->string('brand',50);
            $table->enum('status',['active','maintainence','inactive'])->default('active');
            $table->string('photo',300)->nullable();
            $table->string('yearAdded',6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
