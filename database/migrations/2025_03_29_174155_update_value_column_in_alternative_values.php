<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('alternative_values', function (Blueprint $table) {
            $table->decimal('value', 15, 2)->change(); // Ubah ukuran menjadi 15 digit dengan 2 desimal
        });
    }

    public function down()
    {
        Schema::table('alternative_values', function (Blueprint $table) {
            $table->decimal('value', 10, 2)->change(); // Kembalikan ke ukuran semula
        });
    }
};
