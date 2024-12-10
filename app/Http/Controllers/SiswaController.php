<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use App\Imports\DataSiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Map;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = SiswaModel::query();

        // Filter berdasarkan kategori kelas
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kelas', $request->kategori);
        }

        // Pencarian berdasarkan nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Urutkan data berdasarkan nama
        $query->orderBy('kelas', 'asc')->orderBy('nama', 'asc');

        $siswa = $query->get();

        $totalSiswa = $siswa->count();
        $kelasX = $siswa->where('kelas', '10')->count();
        $kelasXI = $siswa->where('kelas', '11')->count();
        $kelasXII = $siswa->where('kelas', '12')->count();

        return view('view.siswa', compact('siswa', 'totalSiswa', 'kelasX', 'kelasXI', 'kelasXII'));
    }

    public function admin(Request $request)
    {
        $query = SiswaModel::query();

        // Filter berdasarkan kategori kelas
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kelas', $request->kategori);
        }

        // Pencarian berdasarkan nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Urutkan data berdasarkan nama
        $query->orderBy('kelas', 'asc')->orderBy('nama', 'asc');

        $kategori = $request->get('kategori', 'all'); // Default to 'all' if not set

        if ($kategori === 'alumni') {
            $siswa = $query->simplePaginate(20)->appends($request->all());
        } else {
            $siswa = $query->get();
        }

        $hasAlumni = SiswaModel::where('kelas', 'alumni')->exists();

        return view('admin.siswa.admin-siswa', compact('siswa', 'hasAlumni', 'kategori'));
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
        $request->validate(
            [
                'nama' => 'required|string|max:30',
                'nis' => 'required|integer',
                'kelas' => 'required|string',
                'angkatan' => 'required|integer',
                'jurusan' => 'required|string',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
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
            ]
        );

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

        if ($request->filled('latitude') && $request->filled('longitude')) {
            $siswa->latitude = $request->input('latitude');
            $siswa->longitude = $request->input('longitude');
            
            if (!empty($siswa->latitude) || !empty($siswa->longitude)) {
                if (empty($siswa->map_id)) {
                    // Create a new Map record and associate it with the SiswaModel record
                    $map = new Map();
                    $map->siswa_models_id = $siswa->id;
                    $map->save();
                
                    // Update the SiswaModel record with the map_id
                    $siswa->map_id = $map->id;
                }
            }
        }

        $siswa->save();


        return redirect()->back()->with('success', 'Siswa updated successfully');
    }

    public function destroy(string $id)
    {
        $siswa = SiswaModel::findOrFail($id);

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa not found');
        }

        // Hapus gambar jika ada
        if ($siswa->gambar && file_exists(public_path('assets/images/siswa/' . $siswa->gambar))) {
            unlink(public_path('assets/images/siswa/' . $siswa->gambar));
        }
        $siswa->map()->delete();
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
        $request->validate(
            [
                'nama' => 'required|string|max:30',
                'nis' => 'required|integer|unique:siswa_models,nis',
                'kelas' => 'required|string',
                'angkatan' => 'required|integer',
                'jurusan' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
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
            ]
        );

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
        $siswa->latitude = $request->input('latitude');
        $siswa->longitude = $request->input('longitude');
        $siswa->gambar = $filename;
        $siswa->save();

        // Create a new Map record and associate it with the new SiswaModel record
        $map = new Map();
        $map->siswa_models_id = $siswa->id;
        $map->save();

        // Update the SiswaModel record with the map_id
        $siswa->map_id = $map->id;
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ], [
            'file.required' => 'File wajib diunggah',
            'file.mimes' => 'File harus berformat xlsx atau xls',
        ]);

        if ($request->hasFile('file')) {
            Excel::import(new DataSiswaImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data imported successfully');
        } else {
            return redirect()->back()->with('error', 'No file uploaded');
        }
    }
}
