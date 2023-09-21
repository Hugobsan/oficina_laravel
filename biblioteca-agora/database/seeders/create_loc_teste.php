<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locatario;
use App\Models\User;

class create_loc_teste extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Locatario',
            'email' => 'locatario@agora.com',
            'password' => bcrypt('123'),
        ]);

        //Criando admin 
        Locatario::create([
            'nome' => 'Locatario',
            'cpf' => '12345678910',
            'telefone' => '38988112233',
            'user_id' => $user->id,
        ]);
    }
}
