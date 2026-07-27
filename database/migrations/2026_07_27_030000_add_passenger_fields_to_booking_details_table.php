<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->string('passenger_name')->nullable()->after('seat_id');
            $table->string('gender')->nullable()->after('passenger_name');
            $table->string('identity_number')->nullable()->after('email');
            $table->string('seat_number')->nullable()->after('identity_number');
        });
    }

    public function down(): void
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->dropColumn(['passenger_name', 'gender', 'identity_number', 'seat_number']);
        });
    }
};
