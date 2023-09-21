<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emprestimo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locatario_id');
            $table->unsignedBigInteger('livro_id');
            $table->date('data_emprestimo');
            $table->date('data_devolucao_esperada');
            $table->integer('quantidade_renovacoes')->default(0);
            $table->date('data_devolucao')->nullable()->default(null);
            $table->timestamps();

            // Foreign keys
            $table->foreign('locatario_id')->references('id')->on('locatario');
            $table->foreign('livro_id')->references('id')->on('livro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimo');
    }
};
