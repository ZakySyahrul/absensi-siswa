<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presensi_id')->nullable()->constrained('presensis', 'id')->cascadeOnDelete();
            $table->foreignId('siswa_id')->nullable()->constrained('siswas', 'id')->cascadeOnDelete();
            $table->enum('status_presensi',['Hadir','Sakit','Izin','Alpa']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_siswas');
    }
};