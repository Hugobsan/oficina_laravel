<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class create_locatario_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Criar 10 usuários para os 10 locatários
        \App\Models\User::factory()->count(10)->create();
        
        // Criar 10 locatários
        \App\Models\Locatario::factory()->count(10)->create();
    }
}
