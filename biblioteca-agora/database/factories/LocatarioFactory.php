<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locatario>
 */
class LocatarioFactory extends Factory
{
    protected $model = \App\Models\Locatario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'telefone' => $this->faker->numerify('###########'),
            'cpf' => $this->faker->numerify('###########'),
            'user_id' => \App\Models\User::factory()->create()->id
        ];
    }
}
