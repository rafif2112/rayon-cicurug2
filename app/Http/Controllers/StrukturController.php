<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturModel;

class StrukturController extends Controller
{
    private $publicHtmlPath;

    public function __construct()
    {
        $this->publicHtmlPath = '/home/cicurug2.my.id/public_html/assets/images/struktur';
        // $this->publicHtmlPath = public_path('assets/images/struktur'); //local
    }
    public function index()
    {
        $data = StrukturModel::all();
        return view('home', ['data' => $data]);
    }

    public function admin()
    {
        $data = StrukturModel::all();
        return view('admin.struktur.struktur-admin', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.struktur.struktur-create');
    }

    public function store (Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($this->publicHtmlPath, $filename);

        // Insert data
        $data = new StrukturModel();
        $data->nama = $request->input('nama');
        $data->jabatan = $request->input('jabatan');
        $data->gambar = $filename;

        $data->save();

        return redirect()->back()->with('success', 'Data created successfully');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $struktur = StrukturModel::find($id);
        return view('admin.struktur.struktur-edit', ['struktur' => $struktur]);
    }

    public function update(Request $request, string $id)
    {
        $data = StrukturModel::find($id);

        if (!$data) {
            return redirect()->route('struktur.admin')->with('error', 'Data not found');
        }

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($data->gambar && file_exists($this->publicHtmlPath . $data->gambar)) {
            unlink($this->publicHtmlPath . $data->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($this->publicHtmlPath, $filename);
            $data->gambar = $filename;
        }

        // Update data
        $data->nama = $request->input('nama');
        $data->jabatan = $request->input('jabatan');

        $data->save();

        return redirect()->back()->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = StrukturModel::find($id);

        if (!$data) {
            return redirect()->route('struktur.admin')->with('error', 'Data not found');
        }

        // Hapus gambar jika ada
        if ($data->gambar && file_exists($this->publicHtmlPath . $data->gambar)) {
            unlink($this->publicHtmlPath . $data->gambar);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data deleted successfully');
    }
}