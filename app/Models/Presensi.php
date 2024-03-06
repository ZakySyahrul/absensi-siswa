<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Presensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
    public function mapel(): BelongsTo
    {
        return $this->BelongsTo(Mapel::class);
        
    }
    public function kelas(): BelongsTo
    {
        return $this->BelongsTo(Kelas::class);
    }
    public function presensi_siswa(): BelongsTo
    {
        return $this->BelongsTo(Presensi_siswa::class);
    }
}