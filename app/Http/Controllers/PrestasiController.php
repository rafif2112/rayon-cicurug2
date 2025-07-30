<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    private $publicPath;

    public function __construct()
    {
        // $this->publicPath = '/home/cicurug2.my.id/public_html/assets/images/prestasi/'; //production
        $this->publicPath = public_path('assets/images/prestasi/'); //local
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prestasi = Prestasi::orderBy('created_at', 'desc')->get();

        if ($request->kategori && $request->kategori != 'all') {
            $prestasi = Prestasi::where('tahun', $request->kategori)->orderBy('created_at', 'desc')->get();
        }

        return view('view.prestasi', compact('prestasi'));
    }

    public function admin()
    {
        $prestasi = Prestasi::orderBy('created_at', 'desc')->get();
        return view('admin.prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'gambar.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'tahun' => 'required|integer|min:2024|max:' . date('Y'),
                'deskripsi' => 'required|string|max:1000',
            ], [
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'gambar.*.required' => 'Gambar wajib diupload',
                'gambar.*.image' => 'File harus berupa gambar',
                'gambar.*.mimes' => 'Gambar harus berformat JPEG, PNG, atau JPG',
                'gambar.*.max' => 'Ukuran gambar maksimal 2MB',
                'tahun.required' => 'Tahun wajib diisi',
                'tahun.integer' => 'Tahun harus berupa angka',
                'tahun.min' => 'Tahun minimal 2024',
                'tahun.max' => 'Tahun tidak boleh lebih dari tahun sekarang',
                'deskripsi.required' => 'Deskripsi wajib diisi',
                'deskripsi.max' => 'Deskripsi maksimal 1000 karakter',
            ]);

            $filenames = [];
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    if ($file->isValid()) {
                        $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        $file->move($this->publicPath, $filename);
                        $filenames[] = $filename;
                    } else {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'File gambar tidak valid atau rusak');
                    }
                }
            }

            if (empty($filenames)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Minimal satu gambar harus diupload');
            }

            $prestasi = new Prestasi();
            $prestasi->nama = $request->nama;
            $prestasi->gambar = $filenames;
            $prestasi->tahun = $request->tahun;
            $prestasi->deskripsi = $request->deskripsi;
            $prestasi->save();

            return redirect()->route('prestasi.admin')->with('success', 'Data prestasi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $prestasi = Prestasi::find($id);

            if (!$prestasi) {
                return redirect()->route('prestasi.admin')->with('error', 'Data prestasi tidak ditemukan');
            }

            $request->validate([
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:1000',
                'tahun' => 'required|integer|min:2024|max:' . date('Y'),
                'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'deskripsi.required' => 'Deskripsi wajib diisi',
                'deskripsi.max' => 'Deskripsi maksimal 1000 karakter',
                'tahun.required' => 'Tahun wajib diisi',
                'tahun.integer' => 'Tahun harus berupa angka',
                'tahun.min' => 'Tahun minimal 2024',
                'tahun.max' => 'Tahun tidak boleh lebih dari tahun sekarang',
                'gambar.*.image' => 'File harus berupa gambar',
                'gambar.*.mimes' => 'Gambar harus berformat JPEG, PNG, atau JPG',
                'gambar.*.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            $filenames = $prestasi->gambar ?? [];

            // Handle deleted images
            if ($request->deleted_images) {
                $deletedImages = json_decode($request->deleted_images);
                foreach ($deletedImages as $deletedImage) {
                    if (($key = array_search($deletedImage, $filenames)) !== false) {
                        unset($filenames[$key]);
                        $filePath = $this->publicPath . $deletedImage;
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
                $filenames = array_values($filenames); // Reindex array
            }

            // Handle new images
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    if ($file->isValid()) {
                        $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        $file->move($this->publicPath, $filename);
                        $filenames[] = $filename;
                    } else {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'File gambar tidak valid atau rusak');
                    }
                }
            }

            $prestasi->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filenames,
                'tahun' => $request->tahun,
            ]);

            return redirect()->route('prestasi.admin')->with('success', 'Data prestasi berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi, $id)
    {
        $prestasi = Prestasi::find($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $prestasi = Prestasi::find($id);

    //     if (!$prestasi) {
    //         return redirect()->route('prestasi.admin')->with('error', 'Data not found');
    //     }

    //     $request->validate([
    //         'nama' => 'required',
    //         'deskripsi' => 'required|max:1000',
    //         'tahun' => 'required',
    //         'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    //     ], [
    //         'nama.required' => 'Nama tidak boleh kosong',
    //         'deskripsi.required' => 'Deskripsi tidak boleh kosong',
    //         'deskripsi.max' => 'Deskripsi maksimal 1000 karakter',
    //         'tahun.required' => 'Tahun tidak boleh kosong',
    //         'gambar.*.image' => 'File harus berupa gambar',
    //         'gambar.*.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
    //         'gambar.*.max' => 'Ukuran gambar maksimal 2MB',
    //     ]);

    //     $filenames = $prestasi->gambar;
    //     if ($request->hasFile('gambar')) {
    //         foreach ($request->file('gambar') as $file) {
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             $file->move($this->publicPath, $filename);
    //             $filenames[] = $filename;
    //         }
    //     }

    //     if ($request->deleted_images) {
    //         $deletedImages = json_decode($request->deleted_images);
    //         foreach ($deletedImages as $deletedImage) {
    //             if (($key = array_search($deletedImage, $filenames)) !== false) {
    //                 unset($filenames[$key]);
    //                 $filePath = $this->publicPath . $deletedImage;
    //                 if (file_exists($filePath)) {
    //                     unlink($filePath);
    //                 }
    //             }
    //         }
    //     }

    //     $prestasi->update([
    //         'nama' => $request->nama,
    //         'deskripsi' => $request->deskripsi,
    //         'gambar' => array_values($filenames),
    //         'tahun' => $request->tahun,
    //     ]);

    //     return redirect()->back()->with('success', 'Data berhasil diubah');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi, $id)
    {
        $prestasi = Prestasi::find($id);

        if (!$prestasi) {
            return redirect()->route('prestasi.admin')->with('error', 'Data not found');
        }

        $images = $prestasi->gambar;
        foreach ($images as $image) {
            $filePath = $this->publicPath . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $prestasi->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
