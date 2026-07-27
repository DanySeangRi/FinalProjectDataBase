<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();

            $table->string('origin');
            $table->string('destination');
            $table->integer('distance')->nullable();

            // Removed duration_minutes

            $table->string('status')->default('active');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};