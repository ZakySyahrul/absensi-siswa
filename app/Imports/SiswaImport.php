<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $kelas_id = Kelas::where('nama_kelas', $row['kelas'])->first();

            if ($kelas_id != null) {
                Siswa::create([
                    'nisn' => $row['nisn'],
                    'nama_lengkap' => $row['nama_lengkap'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'kelas_id' => $kelas_id['id'],
                    'telepon' => $row['telepon'],
                ]);
            }
        }
    }
}