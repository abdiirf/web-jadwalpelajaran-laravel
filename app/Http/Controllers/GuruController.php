<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::latest()->paginate(5);

        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('guru.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama_guru'     => 'required',
            'no_hp'     => 'required',
            'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Mengubah 'foto' menjadi 'image'
        ]);

        //upload foto
        $foto = $request->file('foto');
        $foto->storeAs('public/posts', $foto->hashName());

        //create guru
        Guru::create([
            'nama_guru'     => $request->nama_guru,
            'no_hp'     => $request->no_hp,
            'foto'     => $foto->hashName(),
        ]);

        //redirect to index
        return redirect()->route('guru.index')->with(['success' => 'Guru Berhasil Disimpan!']);
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
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        //validate form
        $this->validate($request, [
            'nama_guru'     => 'required',
            'no_hp'     => 'required',
            'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if foto is uploaded
        if ($request->hasFile('foto')) {

            //upload new foto
            $foto = $request->file('foto');
            $foto->storeAs('public/posts', $foto->hashName());

            //delete old foto
            Storage::delete('public/posts/'.$guru->foto);

            //update guru with new foto
            $guru->update([
                'nama_guru'     => $request->nama_guru,
                'no_hp'     => $request->no_hp,
                'foto'     => $foto->hashName(),
            ]);

        } else {

            //update barang without foto
            $barang->update([
                'nama_guru'     => $request->nama_guru,
                'no_hp'     => $request->no_hp,
            ]);
        }

        //redirect to index
        return redirect()->route('guru.index')->with(['success' => 'Guru Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        Storage::delete('public/posts/'. $guru->foto);

        //delete guru
        $guru->delete();

        //redirect to index
        return redirect()->route('guru.index')->with(['success' => 'Guru Berhasil Dihapus!']);
    }

}
