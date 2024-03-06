<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Http\Requests\StorePresensiRequest;
use App\Http\Requests\UpdatePresensiRequest;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("presensi.presensi", [
            'presensi' => Presensi::all(),
            'mapel' => Mapel::all(),
            'guru' => Guru::all(),
            'kelas'=>Kelas::all()], );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //     return view("presensi.tambah_presensi", [
        //         'guru' => Guru::all(),
        //         'mapel' => Mapel::all(),
        //         'kelas' => Kelas::all()
        //     ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresensiRequest $request)
    {
        $validatedData = $request->validate([
            'guru_id' => ['required'],
            'mapel_id' => ['required'],
            'kelas_id' => ['required'],
            'materi' => ['required'],
        ]);

        Presensi::create($validatedData);

        return redirect('/presensi')->with('successCreate', 'Tambah data Presensi berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        return view('presensi.ubah_presensi', [
            'presensi' => $presensi,
            'kelas' => Kelas::all(),
            'guru' => Guru::all(),
            'mapel' => Mapel::all(),



        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresensiRequest $request, Presensi $presensi)
    {
        $validatedData = $request->validate([
            'guru_id' => ['required'],
            'mapel_id' => ['required'],
            'kelas_id' => ['required'],
            'materi' => ['required'],
        ]);


        $presensi->update($validatedData);

        return redirect('/presensi')->with('successCreate', 'Tambah data Presensi berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        $presensi->delete();

        return redirect('/presensi')->with('successDelete', 'Hapus data Presensi berhasil');
    }
}