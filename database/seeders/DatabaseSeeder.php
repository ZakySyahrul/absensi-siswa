<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Siswa::factory()->count(32)->create();
        // Guru::factory()->count(90)->create();
        // Mapel::factory()->count(15)->create();
        // Kelas::factory()->count(9)->create();
        // Presensi::factory()->count(9)->create();
    }
}