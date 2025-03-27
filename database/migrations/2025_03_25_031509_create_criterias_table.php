<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama');
            $table->decimal('bobot', 5, 2);
            $table->enum('atribut', ['Benefit', 'Cost']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criterias');
    }
};
