<?php

namespace App\Http\Controllers;

use App\Models\GaleriModel;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
        public function index()
    {
        $images = GaleriModel::all();
        return view('admin.galeri.galeri', ['images' => $images]);
    }

    public function admin()
    {
        $gambar = GaleriModel::all();
        return view('admin.galeri.galeri', ['gambar' => $gambar]);
    }

    public function create()
    {
        $images = GaleriModel::all(); // or fetch specific images as needed
        return view('admin.galeri.galeri-create', compact('images'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:30',
            'gambar' => 'required|image|max:2048',
        ]);

        // Handle file upload
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/images/galeri/'), $filename);

        // Insert data galeri
        $galeri = new GaleriModel();
        $galeri->gambar = $filename;

        $galeri->judul = $request->input('judul');

        $galeri->save();

        return redirect()->back()->with('success', 'Galeri created successfully');
    }

    /**`
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $image = GaleriModel::find($id);
        return view('admin.galeri.galeri-edit', ['image' => $image]);
    }

    public function update(Request $request, string $id)
    {
        $image = GaleriModel::find($id);

        if (!$image) {
            return redirect()->route('galeri.admin')->with('error', 'Siswa not found');
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:30',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($image->gambar && file_exists(public_path('assets/images/galeri/' . $image->gambar))) {
                unlink(public_path('assets/images/galeri/' . $image->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/galeri/'), $filename);
            $image->gambar = $filename;
            $image->judul = $request->input('judul');
        } else {
            // Hapus gambar lama jika tidak ada gambar baru yang diupload
            if ($image->gambar && file_exists(public_path('assets/images/galeri/' . $image->gambar))) {
                unlink(public_path('assets/images/galeri/' . $image->gambar));
                $image->gambar = null;
            }
        }

        // Save the updated image model
        $image->save();

        return redirect()->back()->with('success', 'Siswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = GaleriModel::find($id);

        if ($image) {
            // Hapus gambar jika ada
            if ($image->gambar && file_exists(public_path('assets/images/galeri/' . $image->gambar))) {
                unlink(public_path('assets/images/galeri/' . $image->gambar));
            }

            $image->delete();
            return redirect()->route('galeri.admin')->with('success', 'Galeri deleted successfully');
        }

        return redirect()->route('galeri.admin')->with('error', 'Galeri not found');
    }
}
