<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mapel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_mapel');
    }
    public function presensi_siswa(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'nama_mapel');
    }
}