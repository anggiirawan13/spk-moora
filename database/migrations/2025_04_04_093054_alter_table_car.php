<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('license_plate');
            $table->dropColumn('owner_name');
            $table->dropColumn('owner_address');
        });
    }

    public function down(): void
    {
    }
};
