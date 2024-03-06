<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kelas' => fake()->randomElement(['RPL 1', 'RPL 2', 'DKV 1', 'DKV 2', 'DKV 3', 'DKV 4', 'DKV 5', 'DKV 6',] ),
            'guru_id'=> fake()->numberBetween(1, 20)
        ];
    }
}