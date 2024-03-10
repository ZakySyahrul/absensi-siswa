<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Presensi_siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.siswa', ['siswa' => Siswa::all(), 'kelas' => Kelas::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view("siswa.tambah_siswa",  ['kelas' => Kelas::all(),]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $validatedData = $request->validate([
            'nisn' => ['required', 'unique:siswas', 'regex:/^[0-9]{1,10}$/'],
            'nama_lengkap' => ['required', 'regex:/^[a-zA-Z\s\'-]+$/'],
            'jenis_kelamin' => ['required'],
            'kelas_id' => ['required'],
            'telepon' => ['required', 'unique:siswas', 'regex:/^[^a-zA-Z]*$/'],
        ], [
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh mengandung huruf, spasi, tanda kutip (\'), dan tanda hubung (-).',
            'nisn.regex' => 'Nisn harus berupa angka dan Max-10.',
            'telepon.regex' => 'Nomor Telepon harus berupa angka.'
        ]);

        Siswa::create($validatedData);

        return redirect('/siswa')->with('success', 'Tambah data siswa berhasil')->withErrors($validatedData);
    }



    public function import(Request $request)
    {
        // Memeriksa apakah file yang diunggah adalah file Excel
        if ($request->hasFile('import') && $request->file('import')->getClientOriginalExtension() == 'xlsx') {
            // Jika benar, melakukan import data
            Excel::import(new SiswaImport, $request->file('import'));
            return redirect('/siswa')->with('success', 'Data berhasil di import.');
        } else {
            // Jika bukan file Excel, kirimkan pesan peringatan
            return redirect('/siswa')->with('error', 'Hanya file Excel (.xlsx) yang diizinkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.ubah_siswa', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nisn' => ['required', 'regex:/^[0-9]{1,10}$/','unique:siswas,nisn,' . $siswa->id],
            'nama_lengkap' => ['required'],
            'jenis_kelamin' => ['required'],
            'kelas_id' => ['required'],
            'telepon' => ['required', 'unique:siswas,telepon,' . $siswa->id],
        ]);

        $siswa->update($validatedData);

        return redirect('/siswa')->with('success', 'Ubah data siswa berhasil');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect('/siswa')->with('success', 'Hapus data siswa berhasil');
    }
}