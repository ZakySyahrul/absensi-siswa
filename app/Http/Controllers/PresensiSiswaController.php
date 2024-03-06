<?php

namespace App\Http\Controllers;

use App\Models\Presensi_siswa;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Http\Requests\StorePresensi_siswaRequest;
use App\Http\Requests\UpdatePresensi_siswaRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;


class PresensiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kelas)
    {
        return view("presensi_siswa.presensi_siswa", [
            'presensi_siswa' => Presensi_Siswa::all(),
            'kelas' => Kelas::where('id', $kelas)->first(),
            'mapel' => Mapel::all(),
            'siswa' => Siswa::where('kelas_id', $kelas)->get(),
            'guru' => Guru::all(),
            'presensi' => Presensi::all()
        ]);

       // Menghitung total siswa yang tercatat dalam tabel presensi_siswas
    $totalSiswa = Presensi_siswa::count();

    // Menghitung jumlah siswa yang hadir
    $totalHadir = Presensi_siswa::where('status_presensi', 'Hadir')->count();

    // Menghitung presentase kehadiran
    $presentaseKehadiran = $totalSiswa > 0 ? ($totalHadir / $totalSiswa) * 100 : 0;

    // Mengambil data presensi siswa yang masuk ke dalam rentang persentase kehadiran
    $presensiHadir = Presensi_siswa::where('status_presensi', 'Hadir')
                        ->get();

    // Mengirim data presentasi siswa ke view tanpa menggunakan compact()
    return view('dashboard')->with([
        'presentaseKehadiran' => $presentaseKehadiran,
        'presensiHadir' => $presensiHadir
    ]);
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view("presensi_siswa.tambah_presensi_siswa", [
    //         'presensi' => Presensi::all(),
    //         'siswa' => Siswa::all(),
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresensi_siswaRequest $request)
    {

        $validatedData = $request->validate([
            'guru_id' => ['required'],
            'mapel_id' => ['required'],
            'kelas_id' => ['required'],
            'materi' => ['required'],
        ]);

        Presensi::create($validatedData);


        $presensi_id = Presensi::orderBy('created_at', 'desc')->first();


        for ($i = 0; $i <  count($request->siswa_id); $i++) {
            Presensi_siswa::create([
                'presensi_id' => $presensi_id->id,
                'siswa_id' => $request->siswa_id[$i],
                'status_presensi' => $request['status_presensi' . $request->siswa_id[$i]],
                'keterangan' => $request['keterangan' . $request->siswa_id[$i]],
            ]);
        };

        // Presensi_siswa::create($validatedData);

        return redirect('/laporan')->with('success', 'Tambah data Presensi berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi_siswa $presensi_siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi_siswa $presensi_siswa)
    {
        return view('presensi_siswa.ubah_presensi_siswa', [
            'presensi_siswa' => $presensi_siswa,
            'siswa' => Siswa::all(),
            'presensi' => Presensi::all(),



        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresensi_siswaRequest $request, Presensi_siswa $presensi_siswa)
    {
        $validatedData = $request->validate([
            'presensi_id' => ['required'],
            'siswa_id' => ['required'],
            'status_presensi' => ['required'],
            'keterangan' => ['required'],
        ]);


        $presensi_siswa->update($validatedData);

        return redirect('/presensi_siswa')->with('successCreate', 'Ubah data Presensi berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi_siswa $presensi_siswa)
    {
        $presensi_siswa->delete();

        return redirect('/presensi_siswa')->with('successDelete', 'Hapus data Presensi berhasil');
    }
}