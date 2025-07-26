<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->autoIncrement()->primary();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('fuel_types');
    }
};

