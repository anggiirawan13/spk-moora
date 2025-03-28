<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name')->index();
            $table->decimal('weight', 5, 2);
            $table->enum('attribute_type', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criterias');
    }
};
