<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Guru;
use App\Models\User;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("mapel.mapel", ['mapel' => Mapel::all(), 
        'user' => User::all(),]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view("mapel.tambah_mapel",  ['guru' => Guru::all(),]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapelRequest $request)
    {
        $validatedData = $request->validate([
            'nama_mapel' => ['required', 'unique:mapels'],
            'guru_mapel' => ['required'],
        ]);


        Mapel::create($validatedData);

        return redirect('/mapel')->with('success', 'Tambah data mapel berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Mapel $mapel)
    // {
    //     return view('mapel.mapel', [
    //         'mapel' => $mapel,
    //         'guru' => Guru::all(),
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMapelRequest $request, Mapel $mapel)
    {
        $validatedData = $request->validate([
            'nama_mapel' => ['required', 'unique:mapels,nama_mapel,' . $mapel->id],
            'guru_mapel' => ['required'],
        ]);


        $mapel->update($validatedData);

        return redirect('/mapel')->with('success', 'Update data mapel berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();

        return redirect('/mapel')->with('success', 'Hapus data mapel berhasil');
    }
}