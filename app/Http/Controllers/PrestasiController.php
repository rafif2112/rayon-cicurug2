<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    private $publicPath;
    public function __construct()
    {
        $this->publicPath = public_path('assets/images/prestasi/');
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
        $request->validate([
            'nama' => 'required',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tahun' => 'required|integer',
            'deskripsi' => 'required|max:1000',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'gambar.*.required' => 'Gambar tidak boleh kosong',
            'gambar.*.image' => 'File harus berupa gambar',
            'gambar.*.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'gambar.*.max' => 'Ukuran gambar maksimal 2MB',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.integer' => 'Tahun harus berupa angka',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter',
        ]);

        $filenames = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($this->publicPath, $filename);
                $filenames[] = $filename;
            }
        }

        $prestasi = new Prestasi();
        $prestasi->nama = $request->nama;
        $prestasi->gambar = $filenames;
        $prestasi->tahun = $request->tahun;
        $prestasi->deskripsi = $request->deskripsi;
        $prestasi->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
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
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::find($id);

        if (!$prestasi) {
            return redirect()->route('prestasi.admin')->with('error', 'Data not found');
        }

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required|max:1000',
            'tahun' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'gambar.*.image' => 'File harus berupa gambar',
            'gambar.*.mimes' => 'Gambar harus berformat jpeg, png, atau jpg',
            'gambar.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $filenames = $prestasi->gambar;
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($this->publicPath, $filename);
                $filenames[] = $filename;
            }
        }

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
        }

        $prestasi->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => array_values($filenames),
            'tahun' => $request->tahun,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

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
