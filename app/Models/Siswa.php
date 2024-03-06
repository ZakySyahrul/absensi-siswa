<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nisn', 'nama_lengkap', 'jenis_kelamin', 'kelas_id', 'telepon'];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function presensi_siswa(): BelongsTo
    {
        return $this->belongsTo(Presensi_siswa::class);
    }

    public static function getTotalSiswa()
    {
        return self::count();
    }
    // Aturan validasi unik untuk NISN dan telepon
    public static function rules($id = null)
    {
        return [
            'nisn' => ['required', Rule::unique('siswas')->ignore($id)],
            'telepon' => ['required', Rule::unique('siswas')->ignore($id)],
        ];
    }
}