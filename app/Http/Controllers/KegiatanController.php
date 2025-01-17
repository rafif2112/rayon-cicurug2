<?php

namespace App\Http\Controllers;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    private $publicHtmlPath;

    public function __construct()
    {
        // $this->publicHtmlPath = '/home/cicurug2.my.id/public_html/assets/images/kegiatan';
        $this->publicHtmlPath = public_path('assets/images/kegiatan');
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
            'deskripsi' => 'required|string|max:255',
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
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($this->publicHtmlPath, $filename);
                $filenames[] = $filename;
            }
        }

        $data = new KegiatanModel();
        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');
        $data->gambar = json_encode($filenames);

        $data->save();

        return redirect()->back()->with('success', 'Data created successfully');
    }

    public function update(Request $request, string $id)
    {
        $data = KegiatanModel::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'gambar.*.image' => 'File harus berupa gambar',
            'gambar.*.mimes' => 'File harus berformat jpeg, png, jpg',
            'gambar.*.max' => 'Ukuran file maksimal 2MB',
        ]);

        $filenames = [];
        if ($request->hasFile('gambar')) {
            // Delete old images
            $oldImages = json_decode($data->gambar) ?? [];
            foreach ($oldImages as $oldImage) {
                $oldImagePath = $this->publicHtmlPath . '/' . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new images
            foreach ($request->file('gambar') as $file) {
                if ($file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move($this->publicHtmlPath, $filename);
                    $filenames[] = $filename;
                }
            }
        } else {
            $filenames = json_decode($data->gambar) ?? [];
        }

        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');
        $data->gambar = json_encode($filenames);

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
        if ($data->gambar && file_exists($this->publicHtmlPath . '/' . $data->gambar)) {
            unlink($this->publicHtmlPath . '/' . $data->gambar);
        }
        $data->delete();
        return redirect()->route('kegiatan.admin')->with('success', 'Data deleted successfully');
    }
}
