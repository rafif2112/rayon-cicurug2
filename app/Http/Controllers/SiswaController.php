<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use App\Imports\DataSiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Map;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    private $publicHtmlPath;

    public function __construct()
    {
        $this->publicHtmlPath = '/home/cicurug2.my.id/public_html/assets/images/siswa'; //production
        // $this->publicHtmlPath = public_path('assets/images/siswa'); //local
    }

    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'all');

        $allSiswa = SiswaModel::all();

        if ($kategori === 'alumni') {
            $siswa = SiswaModel::where('kelas', 'alumni')->orderBy('angkatan', 'desc')->orderBy('nama', 'asc');
            if ($request->filled('search')) {
                $siswa->where('nama', 'like', '%' . $request->search . '%');
            }
            $siswa = $siswa->simplePaginate(20)->appends($request->all());
        } else if ($kategori !== 'all') {
            $siswa = SiswaModel::where('kelas', $request->kategori)->orderBy('kelas', 'asc')->orderBy('nama', 'asc');
            if ($request->filled('search')) {
                $siswa->where('nama', 'like', '%' . $request->search . '%');
            }
            $siswa = $siswa->get();
        } else {
            $siswa = SiswaModel::where('kelas', '!=', 'alumni')->orderBy('kelas', 'asc')->orderBy('nama', 'asc');
            if ($request->filled('search')) {
                $siswa->where('nama', 'like', '%' . $request->search . '%');
            }
            $siswa = $siswa->get();
        }

        $totalSiswa = $allSiswa->where('kelas', '!=', 'alumni')->count();
        $kelasX = $allSiswa->where('kelas', '10')->count();
        $kelasXI = $allSiswa->where('kelas', '11')->count();
        $kelasXII = $allSiswa->where('kelas', '12')->count();

        $hasAlumni = SiswaModel::where('kelas', 'alumni')->exists();

        return view('view.siswa', compact('siswa', 'totalSiswa', 'kelasX', 'kelasXI', 'kelasXII', 'hasAlumni', 'kategori'));
    }


    public function admin(Request $request)
    {
        $kategori = $request->get('kategori', 'all');

        if ($kategori === 'alumni') {
            $siswa = SiswaModel::where('kelas', 'alumni')
                ->when($request->filled('search'), function ($query) use ($request) {
                    return $query->where('nama', 'like', '%' . $request->search . '%');
                })
                ->orderBy('angkatan', 'desc')
                ->orderBy('nama', 'asc')
                ->simplePaginate(20)
                ->appends(['search' => $request->search, 'kategori' => $kategori]);
        } else if ($kategori !== 'all') {
            $siswa = SiswaModel::where('kelas', $request->kategori);
            if ($request->filled('search')) {
                $siswa->where('nama', 'like', '%' . $request->search . '%');
            }
            $siswa = $siswa->orderBy('kelas', 'asc')
                ->orderBy('nama', 'asc')
                ->get();
        } else {
            $siswa = SiswaModel::where('kelas', '!=', 'alumni');
            if ($request->filled('search')) {
                $siswa->where('nama', 'like', '%' . $request->search . '%');
            }
            $siswa = $siswa->orderBy('kelas', 'asc')
                ->orderBy('nama', 'asc')
                ->get();
        }

        $hasAlumni = SiswaModel::where('kelas', 'alumni')->exists();

        return view('admin.siswa.admin-siswa', compact('siswa', 'hasAlumni', 'kategori'));
    }

    public function portofolio()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        return view('siswa.portofolio', compact('siswa'));
    }

    public function updatePortofolio(Request $request)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $request->validate([
            'deskripsi' => 'nullable|string|max:1000',
            'sertifikat' => 'nullable|array',
            'sertifikat.*.gambar' => 'nullable|array',
            'sertifikat.*.gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'nullable|array',
        ], [
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter',
            'sertifikat.*.gambar.*.image' => 'File harus berupa gambar',
            'sertifikat.*.gambar.*.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'sertifikat.*.gambar.*.max' => 'Gambar tidak boleh lebih dari 2MB',
        ]);

        try {
            $portofolioPath = $this->publicHtmlPath . '/portofolio/' . $siswa->nis;
            if (!file_exists($portofolioPath)) {
                mkdir($portofolioPath, 0755, true);
            }

            $existingSertifikat = $siswa->sertifikat ?? [];

            if ($request->has('deleted_images')) {
                foreach ($request->deleted_images as $sertifikatIndex => $deletedImages) {
                    if (is_array($deletedImages)) {
                        foreach ($deletedImages as $imageName) {
                            $imagePath = $portofolioPath . '/' . $imageName;
                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                            }

                            if (isset($existingSertifikat[$sertifikatIndex]['gambar'])) {
                                $existingSertifikat[$sertifikatIndex]['gambar'] = array_filter(
                                    $existingSertifikat[$sertifikatIndex]['gambar'],
                                    function ($img) use ($imageName) {
                                        return $img !== $imageName;
                                    }
                                );

                                $existingSertifikat[$sertifikatIndex]['gambar'] = array_values(
                                    $existingSertifikat[$sertifikatIndex]['gambar']
                                );

                                if (empty($existingSertifikat[$sertifikatIndex]['gambar'])) {
                                    unset($existingSertifikat[$sertifikatIndex]);
                                }
                            }
                        }
                    }
                }

                $existingSertifikat = array_values($existingSertifikat);
            }

            // Handle new certificate images
            if ($request->has('sertifikat')) {
                foreach ($request->sertifikat as $index => $sertifikat) {
                    if ($request->hasFile("sertifikat.{$index}.gambar")) {
                        // Initialize gambar array if it doesn't exist
                        if (!isset($existingSertifikat[$index]['gambar'])) {
                            $existingSertifikat[$index]['gambar'] = [];
                        }

                        foreach ($request->file("sertifikat.{$index}.gambar") as $fileIndex => $file) {
                            if ($file && $file->isValid()) {
                                $filename = time() . '_' . $index . '_' . $fileIndex . '_' . $file->getClientOriginalName();
                                $file->move($portofolioPath, $filename);
                                $existingSertifikat[$index]['gambar'][] = $filename;
                            }
                        }
                    }
                }
            }

            $newSertifikatData = [];

            // Merge existing and new certificates
            $allSertifikat = array_merge($existingSertifikat, $newSertifikatData);

            // Update data siswa
            $siswa->update([
                'deskripsi' => $request->deskripsi,
                'sertifikat' => $allSertifikat,
            ]);

            return redirect()->back()->with('success', 'Portofolio berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $siswa = SiswaModel::with('user')->find($id);
        return view('admin.siswa.siswa-edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        $siswa = SiswaModel::with('user')->find($id);

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa not found');
        }

        // Validasi input
        $request->validate(
            [
                'nama' => 'nullable|string|max:30',
                'nis' => 'nullable|integer',
                'kelas' => 'nullable|string',
                'angkatan' => 'nullable|integer',
                'jurusan' => 'nullable|string',
                'portofolio' => 'nullable',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'email' => 'required|email|unique:users,email,' . optional($siswa->user)->id, // Update validasi email
            ],
            [
                'nama.max' => 'Nama tidak boleh lebih dari 30 karakter',
                'nis.integer' => 'NIS harus berupa angka',
                'angkatan.integer' => 'Angkatan harus berupa angka',
                'gambar.image' => 'Gambar harus berupa file gambar',
                'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
                'gambar.max' => 'Gambar tidak boleh lebih dari 2048 kilobyte',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email harus valid',
                'email.unique' => 'Email sudah digunakan',
            ]
        );

        // Handle file upload
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($siswa->gambar && file_exists($this->publicHtmlPath . $siswa->gambar)) {
                unlink($this->publicHtmlPath . $siswa->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($this->publicHtmlPath, $filename);
            $siswa->gambar = $filename;
        }

        // Update data siswa
        $siswa->nama = $request->filled('nama') ? $request->input('nama') : $siswa->nama;
        $siswa->nis = $request->filled('nis') ? $request->input('nis') : $siswa->nis;
        $siswa->kelas = $request->filled('kelas') ? $request->input('kelas') : $siswa->kelas;
        $siswa->angkatan = $request->filled('angkatan') ? $request->input('angkatan') : $siswa->angkatan;
        $siswa->jurusan = $request->filled('jurusan') ? $request->input('jurusan') : $siswa->jurusan;
        $siswa->link = $request->filled('portofolio') ? $request->input('portofolio') : $siswa->link;

        if ($request->filled('latitude') && $request->filled('longitude')) {
            $siswa->latitude = $request->input('latitude');
            $siswa->longitude = $request->input('longitude');

            // Handle map relationship
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

        // Update email di tabel users
        if ($siswa->user) {
            $siswa->user->email = $request->filled('email') ? $request->input('email') : $siswa->user->email;
            $siswa->user->save();
        }

        return redirect()->back()->with('success', 'Siswa updated successfully');
    }

    public function destroy(string $id)
    {
        $siswa = SiswaModel::findOrFail($id);

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa not found');
        }

        // Hapus gambar jika ada
        if ($siswa->gambar && file_exists($this->publicHtmlPath . $siswa->gambar)) {
            unlink($this->publicHtmlPath . $siswa->gambar);
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
        $request->validate([
            'nama' => 'required|string|max:30',
            'nis' => 'required|integer|unique:siswa_models,nis',
            'kelas' => 'required|string',
            'angkatan' => 'required|integer',
            'jurusan' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama tidak boleh lebih dari 30 karakter',
            'nis.required' => 'NIS wajib diisi',
            'nis.integer' => 'NIS harus berupa angka',
            'nis.unique' => 'NIS sudah terdaftar',
            'kelas.required' => 'Kelas wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'angkatan.integer' => 'Angkatan harus berupa angka',
            'jurusan.required' => 'Jurusan wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'gambar.max' => 'Gambar tidak boleh lebih dari 2048 kilobyte',
        ]);

        DB::beginTransaction();

        try {
            $filename = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($this->publicHtmlPath, $filename);
            }

            $siswa = new SiswaModel();
            $siswa->nama = $request->input('nama');
            $siswa->slug = SiswaModel::generateSlug($request->input('nama'));
            $siswa->nis = $request->input('nis');
            $siswa->kelas = $request->input('kelas');
            $siswa->angkatan = $request->input('angkatan');
            $siswa->jurusan = $request->input('jurusan');
            $siswa->latitude = $request->input('latitude');
            $siswa->longitude = $request->input('longitude');
            $siswa->link = $request->input('link');
            $siswa->gambar = $filename;
            $siswa->save();

            $map = new Map();
            $map->siswa_models_id = $siswa->id;
            $map->save();

            $siswa->map_id = $map->id;
            $siswa->save();

            // Buat akun user untuk siswa
            $user = new User();
            $namaParts = explode(' ', $siswa->nama);
            if (count($namaParts) > 1 && strlen($namaParts[0]) <= 2) {
                $user->username = $namaParts[0] . $namaParts[1];
            } else {
                $user->username = $namaParts[0];
            }
            $user->email = $request->input('email');
            $user->password = Hash::make($siswa->nis);
            $user->role = 'siswa';
            $user->siswa_id = $siswa->id;
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Siswa created successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if (isset($filename) && $filename && file_exists($this->publicHtmlPath . '/' . $filename)) {
                unlink($this->publicHtmlPath . '/' . $filename);
            }

            return redirect()->back()->with('error', 'Error creating siswa: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $siswa = SiswaModel::where('slug', $slug)->firstOrFail();
        return view('view.siswa-detail', compact('siswa'));
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
