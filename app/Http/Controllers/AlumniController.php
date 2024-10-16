<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::all();
        return view('view.alumni', ['alumni' => $alumni]);
    }

    public function admin()
    {
        $alumni = Alumni::all();
        return view('admin.alumni.alumni-admin', ['alumni' => $alumni]);
    }

    public function create()
    {
        return view('admin.alumni.alumni-create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'tempat_bekerja' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        // Handle file upload
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/images/alumni/'), $filename);

        // Create new Alumni instance and save data
        $alumni = new Alumni;
        $alumni->gambar = $filename;
        $alumni->nama = $request->nama;
        $alumni->jurusan = $request->jurusan;
        $alumni->angkatan = $request->angkatan;
        $alumni->tempat_bekerja = $request->tempat_bekerja;
        $alumni->pekerjaan = $request->pekerjaan;
        $alumni->save();

        return redirect()->back()->with('success', 'Data alumni berhasil ditambahkan');
    }

    public function show(Alumni $alumni)
    {
        //
    }

    public function edit($id)
    {
        $alumni = Alumni::find($id);
        return view('admin.alumni.alumni-edit', ['alumni' => $alumni]);
    }

    public function update(Request $request, Alumni $alumni)
    {
        $alumni = Alumni::find($request->id);
        $alumni->gambar = $request->gambar;
        $alumni->nama = $request->nama;
        $alumni->jurusan = $request->jurusan;
        $alumni->angkatan = $request->angkatan;
        $alumni->tempat_bekerja = $request->tempat_bekerja;
        $alumni->pekerjaan = $request->pekerjaan;
        $alumni->save();

        return redirect()->back()->with('success', 'Data alumni berhasil diubah');
    }

    public function destroy(string $id)
    {
        $alumni = Alumni::find($id);
        
        if (!$alumni) {
            return redirect()->back()->with('error', 'Alumni not found');
        }

        // Hapus gambar jika ada
        if ($alumni->gambar && file_exists(public_path('assets/images/alumni/' . $alumni->gambar))) {
            unlink(public_path('assets/images/alumni/' . $alumni->gambar));
        }

        $alumni->delete();

        return redirect()->back()->with('hapus', 'Alumni deleted successfully');
    }
}
