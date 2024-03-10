<?php

namespace App\Http\Controllers;


use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreGuruRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateGuruRequest;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guru.guru', ['guru' => Guru::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.tambah_guru');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'regex:/^[^0-9]*$/'],
            'nip' => ['required', 'unique:gurus', 'regex:/^[0-9]{1,13}$/'],
            'jenis_kelamin' => ['required'],
            'telepon' => ['required', 'unique:gurus', 'regex:/^[^a-zA-Z]*$/'],
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.regex' => 'Nama Guru tidak boleh mengandung angka.',
            'nip.required' => 'NIP harus diisi.',
            'nip.regex' => 'NIP tidak boleh mengandung huruf dan panjang Max-13.',
            'nip.unique' => 'NIP Sudah ada di daftar',
            'telepon.required' => 'Telepon harus diisi.',
            'telepon.unique' => 'Telepon sudah digunakan.',
        ]);

        if ($request->foto) {
            $validatedData['foto'] = $request->file('foto')->store('foto-guru');
        }

        Guru::create($validatedData);

        return redirect('/guru')->with('success', 'Tambah data guru berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return view('guru.ubah_guru', [
            'guru' => Guru::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
{
    $validatedData = $request->validate([
        'nama' => ['required', 'regex:/^[^0-9]*$/'],
        'nip' => ['required', 'regex:/^[0-9]{1,13}$/','unique:gurus,nip,' . $guru->id],
        'jenis_kelamin' => ['required'],
        'telepon' => ['required', 'unique:gurus,telepon,' . $guru->id, 'regex:/^[^a-zA-Z]*$/'],
    ]);

    if ($request->hasFile('foto')) {
        $validatedData['foto'] = $request->file('foto')->store('foto-guru');
    }

    $guru->update($validatedData);

    return redirect('/guru')->with('success', 'Ubah data guru berhasil');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::delete($guru->foto);
        }
        $guru->delete();

        return redirect('/guru')->with('success', 'Hapus data guru berhasil');
    }

    
}