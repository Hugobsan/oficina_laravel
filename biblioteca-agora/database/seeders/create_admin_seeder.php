<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class create_admin_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        //Criando admin 
        Admin::create([
            'nome' => 'Admininstrador',
            'cpf' => '12345678910',
            'telefone' => '38988112233',
            'user_id' => $user->id,
        ]);
    }
        
}
