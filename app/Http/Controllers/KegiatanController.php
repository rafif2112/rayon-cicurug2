<?php

namespace App\Http\Controllers;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanModel::all();
        return view('view.kegiatan', compact('kegiatan'));
    }

    public function admin()
    {
        $kegiatan = KegiatanModel::all();
        return view('admin.kegiatan.kegiatan-admin', ['kegiatan' => $kegiatan]);
    }

    public function create()
    {
        return view('admin.kegiatan.kegiatan-create');
    }

    public function store (Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/images/kegiatan'), $filename);

        // Insert data
        $data = new KegiatanModel();
        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');
        $data->gambar = $filename;

        $data->save();

        return redirect()->back()->with('success', 'Data created successfully');
    }

    public function edit(string $id)
    {
        $kegiatan = KegiatanModel::find($id);
        return view('admin.kegiatan.kegiatan-edit', ['kegiatan' => $kegiatan]);
    }

    public function update(Request $request, string $id)
    {
        $data = KegiatanModel::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if (strlen($request->input('deskripsi')) > 300) {
            return redirect()->back()->with('error', 'Deskripsi tidak boleh lebih dari 300 karakter')->withInput();
        }

        if (strlen($request->input('judul')) > 70) {
            return redirect()->back()->with('error', 'Judul tidak boleh lebih dari 70 karakter')->withInput();
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($data->gambar && file_exists(public_path('assets/images/kegiatan/' . $data->gambar))) {
                unlink(public_path('assets/images/kegiatan/' . $data->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/kegiatan'), $filename);
            $data->gambar = $filename;
        }

        // Update data
        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');

        $data->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $data = KegiatanModel::find($id);

        if (!$data) {
            return redirect()->route('kegiatan.admin')->with('error', 'Data not found');
        }

        // Hapus gambar jika ada
        if ($data->gambar && file_exists(public_path('assets/images/kegiatan/' . $data->gambar))) {
            unlink(public_path('assets/images/kegiatan/' . $data->gambar));
        }
        $data->delete();
        return redirect()->route('kegiatan.admin')->with('success', 'Data deleted successfully');
    }
}
