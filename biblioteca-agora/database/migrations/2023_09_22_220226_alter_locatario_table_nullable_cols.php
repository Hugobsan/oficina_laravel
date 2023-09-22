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
        Schema::table('locatario', function (Blueprint $table) {
            $table->char('telefone', 11)->nullable()->change();
            $table->char('cpf', 11)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locatario', function (Blueprint $table) {
            $table->char('telefone', 11)->change();
            $table->char('cpf', 11)->change();
        });
    }
};
