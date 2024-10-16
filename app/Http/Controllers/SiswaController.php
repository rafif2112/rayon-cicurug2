<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = SiswaModel::all();
        return view('view.siswa', ['siswa' => $siswa]);
    }

    public function admin()
    {
        $siswa = SiswaModel::all();
        $hasAlumni = SiswaModel::where('kelas', 'alumni')->exists();
        $kelasDropdown = request()->get('kelasDropdown', 'all'); // Default to 'all' if not set

        return view('admin.siswa.admin-siswa', compact('siswa', 'hasAlumni', 'kelasDropdown'));
    }

    public function edit($id)
    {
        $siswa = SiswaModel::find($id);
        return view('admin.siswa.siswa-edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        $siswa = SiswaModel::find($id);

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa not found');
        }

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:30',
            'nis' => 'required|integer',
            'kelas' => 'required|string',
            'angkatan' => 'required|integer',
            'jurusan' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], 
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama tidak boleh lebih dari 30 karakter',
            'nis.required' => 'NIS wajib diisi',
            'nis.integer' => 'NIS harus berupa angka',
            'kelas.required' => 'Kelas wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'angkatan.integer' => 'Angkatan harus berupa angka',
            'jurusan.required' => 'Jurusan wajib diisi',
            'gambar.required' => 'Gambar wajib diunggah',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'gambar.max' => 'Gambar tidak boleh lebih dari 2048 kilobyte',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($siswa->gambar && file_exists(public_path('assets/images/siswa/' . $siswa->gambar))) {
            unlink(public_path('assets/images/siswa/' . $siswa->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/siswa'), $filename);
            $siswa->gambar = $filename;
        }

        // Update data siswa
        $siswa->nama = $request->input('nama');
        $siswa->nis = $request->input('nis');
        $siswa->kelas = $request->input('kelas');
        $siswa->angkatan = $request->input('angkatan');
        $siswa->jurusan = $request->input('jurusan');

        $siswa->save();

        return redirect()->back()->with('success', 'Siswa updated successfully');
    }

    public function destroy(string $id)
    {
        $siswa = SiswaModel::find($id);

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa not found');
        }

        // Hapus gambar jika ada
        if ($siswa->gambar && file_exists(public_path('assets/images/siswa/' . $siswa->gambar))) {
            unlink(public_path('assets/images/siswa/' . $siswa->gambar));
        }

        $siswa->delete();

        return redirect()->back()->with('hapus', 'Siswa deleted successfully');
    }

    public function create()
    {
        return view('admin.siswa.siswa-create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:30',
            'nis' => 'required|integer|unique:siswa,nis',
            'kelas' => 'required|string',
            'angkatan' => 'required|integer',
            'jurusan' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], 
        [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama tidak boleh lebih dari 30 karakter',
            'nis.required' => 'NIS wajib diisi',
            'nis.integer' => 'NIS harus berupa angka',
            'nis.unique' => 'NIS sudah terdaftar',
            'kelas.required' => 'Kelas wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'angkatan.integer' => 'Angkatan harus berupa angka',
            'jurusan.required' => 'Jurusan wajib diisi',
            'gambar.required' => 'Gambar wajib diunggah',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'gambar.max' => 'Gambar tidak boleh lebih dari 2048 kilobyte',
        ]);

        // Handle file upload
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/images/siswa'), $filename);

        // Insert data siswa
        $siswa = new SiswaModel();
        $siswa->nama = $request->input('nama');
        $siswa->nis = $request->input('nis');
        $siswa->kelas = $request->input('kelas');
        $siswa->angkatan = $request->input('angkatan');
        $siswa->jurusan = $request->input('jurusan');
        $siswa->gambar = $filename;

        $siswa->save();

        return redirect()->back()->with('success', 'Siswa created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
