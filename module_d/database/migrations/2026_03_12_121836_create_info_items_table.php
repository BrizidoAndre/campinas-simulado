<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('info_items', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['transportation', 'accommodation', 'shopping']);
            $table->text('icon');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('info_items');
    }
};
