<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presensi>
 */
class PresensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guru_id' => fake()->numberBetween(1, 20),
            'mapel_id' => fake()->numberBetween(1, 15),
            'kelas_id' => fake()->numberBetween(1, 93),
            'materi' => fake()->sentence(),
        ];
    }
}