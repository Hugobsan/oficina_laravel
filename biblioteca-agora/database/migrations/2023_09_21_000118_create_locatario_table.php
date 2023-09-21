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
        Schema::create('locatario', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->index();
            $table->char('cpf', 11)->unique();
            $table->char('telefone', 11)->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locatario');
    }
};
