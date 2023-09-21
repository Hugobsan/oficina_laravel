<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    protected $model = \App\Models\Livro::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(),
            'volume' => $this->faker->numberBetween(1, 10),
            'edicao' => $this->faker->numberBetween(1, 10),
            'numero_paginas' => $this->faker->numberBetween(1, 6000),
            'isbn' => $this->faker->isbn13(),
            'editora' => $this->faker->company(),
            'quantidade' => $this->faker->numberBetween(1, 20),
            'autor_id' => \App\Models\Autor::factory()->create()->id,
            'genero_id' => \App\Models\Genero::factory()->create()->id
        ];
    }
}
