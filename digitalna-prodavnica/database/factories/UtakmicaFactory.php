<?php

namespace Database\Factories;

use App\Models\Stadion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utakmica>
 */
class UtakmicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'timDomacin' => $this->faker->randomElement(['Crvena zvezda', 'Chelsea', 'Manchester United']),
            'timGost' => $this->faker->randomElement(['Partizan', 'Arsenal', 'Manchester City']),
            'tipSporta' => $this->faker->randomElement(['Fudbal', 'Kosarka']),
            'datumVreme' => $this->faker->dateTime(),
            'stadionId' => Stadion::factory()->create()->id,
        ];
    }
}