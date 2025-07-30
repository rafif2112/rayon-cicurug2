<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    private $publicHtmlPath;

    public function __construct()
    {
        $this->publicHtmlPath = '/home/cicurug2.my.id/public_html/assets/images/alumni'; //production
        // $this->publicHtmlPath = public_path('assets/images/alumni'); //local
    }

    public function index()
    {
        $alumni = Alumni::all();
        return view('view.alumni', ['alumni' => $alumni]);
    }

    public function admin(Request $request)
    {
        $query = Alumni::query();

        // Pencarian berdasarkan nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $alumni = $query->get();

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
        $file->move($this->publicHtmlPath, $filename);

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

    public function update(Request $request, $id)
    {
        $alumni = Alumni::find($id);

        if (!$alumni) {
            return redirect()->back()->with('error', 'Alumni not found');
        }

        // Validasi input
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'jurusan' => 'required|string|max:255',
                'angkatan' => 'required|integer',
                'tempat_bekerja' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            ],
            [
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'jurusan.required' => 'Jurusan wajib diisi',
                'angkatan.required' => 'Angkatan wajib diisi',
                'angkatan.integer' => 'Angkatan harus berupa angka',
                'tempat_bekerja.required' => 'Tempat bekerja wajib diisi',
                'pekerjaan.required' => 'Pekerjaan wajib diisi',
                'gambar.image' => 'Gambar harus berupa file gambar',
                'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
                'gambar.max' => 'Gambar tidak boleh lebih dari 2048 kilobyte',
            ]
        );

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($alumni->gambar && file_exists($this->publicHtmlPath . '/' . $alumni->gambar)) {
                unlink($this->publicHtmlPath . '/' . $alumni->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($this->publicHtmlPath, $filename);
            $alumni->gambar = $filename;
        }

        // Update data alumni
        $alumni->nama = $request->input('nama');
        $alumni->jurusan = $request->input('jurusan');
        $alumni->angkatan = $request->input('angkatan');
        $alumni->tempat_bekerja = $request->input('tempat_bekerja');
        $alumni->pekerjaan = $request->input('pekerjaan');

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
        if ($alumni->gambar && file_exists($this->publicHtmlPath . '/' . $alumni->gambar)) {
            unlink($this->publicHtmlPath . '/' . $alumni->gambar);
        }

        $alumni->delete();

        return redirect()->back()->with('success', 'Alumni deleted successfully');
    }
}
