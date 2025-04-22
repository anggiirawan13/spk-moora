<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alternative_values', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_criteria_id')->nullable()->after('criteria_id');
            $table->dropColumn('value');
        });
    }

    public function down()
    {
        Schema::table('alternative_values', function (Blueprint $table) {
            $table->dropColumn('sub_criteria_id');
        });
    }
};
