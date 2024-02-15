<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get posts
        $mapel = Mapel::latest()->paginate(2);

        //render view with posts
        return view('mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_mapel'  => 'required',
        ]);

        Mapel::create([
            'nama_mapel'  => $request->nama_mapel,
        ]);

        // Redirect to index
        return redirect()->route('mapel.index')->with(['success' => 'Mapel Berhasil Disimpan!']);
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
    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
        {
            // Validate form
            $this->validate($request, [
                'nama_mapel'  => 'required',
            ]);

            // Update siswa
            $mapel->update([
                'nama_mapel'  => $request->nama_mapel,
            ]);

            // Redirect to index
            return redirect()->route('mapel.index')->with(['success' => 'Mapel Berhasil Diubah!']);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        //delete mapel
        $mapel->delete();

        //redirect to index
        return redirect()->route('mapel.index')->with(['success' => 'Mapel Berhasil Dihapus!']);
    }
}
