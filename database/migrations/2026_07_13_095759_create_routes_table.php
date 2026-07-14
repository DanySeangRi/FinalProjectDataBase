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
        Schema::create('routes', function (Blueprint $table) {
            $table->id('routeID');
            $table->string('departPlace',100);
            $table->string('arrivePlace',100);
            $table->decimal('distance',8,2);
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('boardStation',250);
            $table->string('dropOffStation',250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
