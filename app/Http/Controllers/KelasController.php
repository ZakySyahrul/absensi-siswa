<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest; { {
    }
}

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("kelas.kelas", [
            'kelas' => Kelas::all(),
            'guru' => Guru::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("kelas.tambah_kelas",  ['guru' => Guru::all(),]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        $validatedData = $request->validate([
            'nama_kelas' => ['required', 'unique:kelas'],
            'guru_id' => ['required', 'unique:kelas'],
        ]);


        Kelas::create($validatedData);

        return redirect('/kelas')->with('success', 'Tambah data kelas berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Kelas $kela)
    {
        return view('kelas.kelas', [
            'kelas' => $kela,
            'guru' => Guru::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kela)
    {
        $validatedData = $request->validate([
            'nama_kelas' => ['required', 'unique:kelas,nama_kelas,' . $kela->id],
            'guru_id' => ['required', 'unique:kelas,guru_id,' . $kela->id],

        ]);

        $kela->update($validatedData);

        return redirect('/kelas')->with('success', 'Ubah data kelas berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect('/kelas')->with('successDelete', 'Hapus data siswa berhasil');
    }
}