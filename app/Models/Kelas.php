<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
    
    public function presensi(): BelongsTo
    {
        return $this->belongsTo(Presensi::class);
    }
}