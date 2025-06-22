<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{

    public function definition(): array
    {
        return [
            'usuario_id' => $this->faker->numberBetween(1, 5),
            'nombre' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail
        ];
    }
}
