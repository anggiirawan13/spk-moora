<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('alternative_values', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->autoIncrement()->primary();

            $table->unsignedSmallInteger('alternative_id');
            $table->unsignedSmallInteger('sub_criteria_id');

            $table->foreign('alternative_id')->references('id')->on('alternatives')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_criteria_id')->references('id')->on('sub_criterias')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('value', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alternative_values');
    }
};
