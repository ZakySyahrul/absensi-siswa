<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nisn' => "00" . fake()->randomNumber(8, true),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'kelas_id' => fake()->numberBetween(2, 2),
            'telepon' => '08' . fake()->numberBetween(1000000000, 9999999999),
        ];
    }
}