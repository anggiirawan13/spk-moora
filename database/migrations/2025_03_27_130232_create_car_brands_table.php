<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('car_brands', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->autoIncrement()->primary();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('car_brands');
    }
};

