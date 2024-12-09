<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Map;

class MapsController extends Controller
{
    public function index()
    {
        // data rumah dengan database
        $rumah = Map::with('siswa')->get();
        return view('view.about', compact('rumah'));
    }

    public function admin()
    {
        // data rumah dengan database
        $rumah = Map::with('siswa')->simplePaginate(20);
        return view('admin.maps.index', compact('rumah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.maps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'angkatan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Map::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rumah = Map::find($id);
        return view('admin.maps.edit', compact('rumah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'angkatan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $rumah = Map::find($id);
        $rumah->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rumah = Map::find($id);
        $rumah->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
