<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;



class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function presensi()
    {
        return $this->belongsTo(Presensi::class, 'guru_id');
    }
}