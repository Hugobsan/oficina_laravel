<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emprestimo>
 */
class EmprestimoFactory extends Factory
{
    protected $model = \App\Models\Emprestimo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data_emprestimo = $this->faker->date();
        return [
            'locatario_id' => \App\Models\Locatario::factory()->create()->id,
            'livro_id' => \App\Models\Livro::factory()->create()->id,
            'data_emprestimo' => $data_emprestimo,
            'data_devolucao_esperada' => date('Y-m-d', strtotime($data_emprestimo . ' + 7 days'))
        ];
    }
}
