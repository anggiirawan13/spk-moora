<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->autoIncrement()->primary();

            $table->unsignedTinyInteger('brand_id');
            $table->unsignedTinyInteger('fuel_type_id');
            $table->unsignedTinyInteger('car_type_id');
            $table->unsignedTinyInteger('transmission_type_id');

            $table->string('name', 100);
            $table->text('image_name')->nullable();
            $table->unsignedInteger('price');
            $table->year('manufacture_year');
            $table->foreign('brand_id')->references('id')->on('car_brands')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('mileage');
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedSmallInteger('engine_capacity');
            $table->foreign('car_type_id')->references('id')->on('car_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('seat_count');
            $table->foreign('transmission_type_id')->references('id')->on('transmission_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('color', 30)->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('is_available')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
