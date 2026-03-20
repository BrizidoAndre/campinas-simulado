<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('song_labels', function (Blueprint $table) {
            $table->integer('song_label_id')->unique();
            $table->foreignId('song_id');
            $table->foreignId('label_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('song_labels');
    }
};
