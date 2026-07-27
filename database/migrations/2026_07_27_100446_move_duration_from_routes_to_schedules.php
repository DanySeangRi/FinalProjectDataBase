<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Drop duration ONLY if it exists on routes table
        if (Schema::hasColumn('routes', 'duration')) {
            Schema::table('routes', function (Blueprint $table) {
                $table->dropColumn('duration');
            });
        }

        // 2. Add duration to route_schedules (or schedules) if it doesn't exist yet
        if (!Schema::hasColumn('route_schedules', 'duration')) {
            Schema::table('route_schedules', function (Blueprint $table) {
                $table->string('duration')->nullable()->after('arrival_time');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('routes', 'duration')) {
            Schema::table('routes', function (Blueprint $table) {
                $table->string('duration')->nullable();
            });
        }

        if (Schema::hasColumn('route_schedules', 'duration')) {
            Schema::table('route_schedules', function (Blueprint $table) {
                $table->dropColumn('duration');
            });
        }
    }
};