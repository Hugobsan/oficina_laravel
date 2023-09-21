<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(create_locatario_seeder::class);
        $this->call(create_generos_seeder::class);
        $this->call(create_autores_seeder::class);
        $this->call(create_livros_seeder::class);
    }
}
