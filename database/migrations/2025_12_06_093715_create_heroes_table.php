<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Judul halaman
            $table->string('word1')->nullable(); // Motto kata 1
            $table->string('word2')->nullable(); // Motto kata 2
            $table->string('word3')->nullable(); // Motto kata 3
            $table->text('deskripsi')->nullable(); // Lead / deskripsi
            $table->string('image')->nullable(); // Background hero
            $table->string('search_placeholder')->nullable(); // Placeholder search
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('heroes');
    }
};
