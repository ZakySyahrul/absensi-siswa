<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Presensi_siswa;
use Illuminate\Support\Facades\App;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.laporan', [
            'presensi_siswa' => Presensi_Siswa::all(),
            'kelas' => Kelas::all()
        ]);
    }

    public function filterByDate(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $kelasId = $request->input('kelas');

    $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->addDay()->endOfDay();

    
    $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay()->setTimezone('Asia/Jakarta');
    $endDate = $endDate->setTimezone('Asia/Jakarta');

    $query = Presensi_Siswa::query()
        ->whereBetween('created_at', [$startDate, $endDate]);

    if ($kelasId) {
        $query->whereHas('siswa', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        });
    }

    $presensi_siswa = $query->get();

    $kelas = Kelas::all();

    return view('laporan.laporan', [
        'presensi_siswa' => $presensi_siswa,
        'kelas' => $kelas, 
    ]);
}
}