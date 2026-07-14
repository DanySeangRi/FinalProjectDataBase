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
       Schema::rename('routes', 'tbl_routes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::rename('tbl_routes', 'routes');
    }
};
