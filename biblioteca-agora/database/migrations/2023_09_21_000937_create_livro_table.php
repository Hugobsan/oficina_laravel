<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livro', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255)->index();
            $table->integer('volume');
            $table->integer('edicao');
            $table->integer('numero_paginas');
            $table->string('isbn', 13)->unique();
            $table->string('editora', 255);
            $table->integer('quantidade');
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('genero_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('autor_id')->references('id')->on('autor');
            $table->foreign('genero_id')->references('id')->on('genero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro');
    }
};
