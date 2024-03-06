<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Presensi_siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard()
    {
        $totalSiswa = Siswa::count();

        $totalGuru = Guru::count();

        $totalMapel = Mapel::count();

        $totalKelas = Kelas::count();

        // Mengambil jumlah siswa yang hadir dari tabel presensi_siswa
        $totalHadir = Presensi_siswa::where('status_presensi', 'Hadir')->count();

        // Mengambil jumlah siswa yang sakit dari tabel presensi_siswa
        $totalSakit = Presensi_siswa::where('status_presensi', 'Sakit')->count();

        // Mengambil jumlah siswa yang izin dari tabel presensi_siswa
        $totalIzin = Presensi_siswa::where('status_presensi', 'Izin')->count();

        // Mengambil jumlah siswa yang alpa dari tabel presensi_siswa
        $totalAlpa = Presensi_siswa::where('status_presensi', 'Alpa')->count();

        
        // Mengirim data ke view
        return view('dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalGuru' => $totalGuru,
            'totalMapel' => $totalMapel,
            'totalKelas' => $totalKelas,
            'totalHadir' => $totalHadir,
            'totalSakit' => $totalSakit,
            'totalIzin' => $totalIzin,
            'totalAlpa' => $totalAlpa,
        ]);
    }
}