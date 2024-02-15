<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Pengajar;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajars = Pengajar::with('guru', 'mapel')->latest()->paginate(2);
        return view('pengajar.index', compact('pengajars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurus = Guru::all();
        $mapels = Mapel::all();
        return view('pengajar.create', compact('gurus', 'mapels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_mapel' => 'required',
            'kelas' => 'required',
            'jam_pelajaran' => 'required',
        ]);

        Pengajar::create([
            'id_guru'  => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'kelas' => $request->kelas,
            'jam_pelajaran' => $request->jam_pelajaran,
        ]);

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $gurus = Guru::all();
        $mapels = Mapel::all();
        return view('pengajar.edit', compact('pengajar', 'gurus', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_mapel' => 'required',
            'kelas' => 'required',
            'jam_pelajaran' => 'required',
        ]);

        $pengajar = Pengajar::findOrFail($id);
        $pengajar->update($request->all());

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $pengajar->delete();

        return redirect()->route('pengajar.index')->with('success', 'Pengajar berhasil dihapus.');
    }
}
