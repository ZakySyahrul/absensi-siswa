<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Prompts\Key;

class Presensi_siswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class,);
    }

    public function presensi(): BelongsTo
    {
        return $this->belongsTo(Presensi::class,);
    }
    
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class,);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class,);
    }
}