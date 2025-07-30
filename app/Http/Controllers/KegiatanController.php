<?php

namespace App\Http\Controllers;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    private $publicHtmlPath;

    public function __construct()
    {
        $this->publicHtmlPath = '/home/cicurug2.my.id/public_html/assets/images/kegiatan';
        // $this->publicHtmlPath = public_path('assets/images/kegiatan');
    }
    
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

    public function edit(string $id)
    {
        $kegiatan = KegiatanModel::find($id);
        return view('admin.kegiatan.kegiatan-edit', ['kegiatan' => $kegiatan]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'gambar.*.required' => 'Gambar tidak boleh kosong',
            'gambar.*.image' => 'File harus berupa gambar',
            'gambar.*.mimes' => 'File harus berformat jpeg, png, jpg',
            'gambar.*.max' => 'Ukuran file maksimal 2MB',
        ]);

        $filenames = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($this->publicHtmlPath, $filename);
                $filenames[] = $filename;
            }
        }

        $data = new KegiatanModel();
        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');
        $data->gambar = json_encode($filenames);

        $data->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $data = KegiatanModel::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deleted_images' => 'nullable|string',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'gambar.*.image' => 'File harus berupa gambar',
            'gambar.*.mimes' => 'File harus berformat jpeg, png, jpg',
            'gambar.*.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Get existing images
        $existingImages = json_decode($data->gambar) ?? [];
        
        // Handle deleted images
        $deletedImages = [];
        if ($request->has('deleted_images') && !empty($request->deleted_images)) {
            $deletedImages = json_decode($request->deleted_images, true) ?? [];
            
            // Remove deleted images from filesystem
            foreach ($deletedImages as $deletedImage) {
                $imagePath = $this->publicHtmlPath . '/' . $deletedImage;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            // Remove deleted images from existing images array
            $existingImages = array_filter($existingImages, function($image) use ($deletedImages) {
                return !in_array($image, $deletedImages);
            });
        }

        // Handle new uploaded images
        $newImages = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                if ($file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($this->publicHtmlPath, $filename);
                    $newImages[] = $filename;
                }
            }
        }

        // Combine existing and new images
        $finalImages = array_merge(array_values($existingImages), $newImages);
        
        // Validate that we have at least one image
        if (empty($finalImages)) {
            return redirect()->back()->withErrors(['gambar' => 'Minimal harus ada satu gambar untuk kegiatan']);
        }

        // Update data
        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');
        $data->gambar = json_encode($finalImages);

        $data->save();

        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $data = KegiatanModel::find($id);

        if (!$data) {
            return redirect()->route('kegiatan.admin')->with('error', 'Data tidak ditemukan');
        }

        // Delete all images
        $images = json_decode($data->gambar) ?? [];
        foreach ($images as $image) {
            $imagePath = $this->publicHtmlPath . '/' . $image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $data->delete();
        return redirect()->route('kegiatan.admin')->with('success', 'Kegiatan berhasil dihapus');
    }
}