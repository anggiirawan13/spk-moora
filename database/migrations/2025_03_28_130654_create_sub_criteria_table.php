<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sub_criterias', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->autoIncrement()->primary();
            
            $table->unsignedSmallInteger('criteria_id');

            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade');
            $table->string('name', 100);
            $table->unsignedInteger('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_criterias');
    }
};
