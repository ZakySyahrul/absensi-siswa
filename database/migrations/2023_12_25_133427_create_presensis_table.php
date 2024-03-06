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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('mapel_id')->nullable()->constrained('mapels', 'id')->cascadeOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas', 'id')->cascadeOnDelete();
            $table->text('materi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};