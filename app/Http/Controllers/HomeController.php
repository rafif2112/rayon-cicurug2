<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturModel;
use App\Models\GaleriModel;
use App\Models\SiswaModel;
use App\Models\Alumni;
use App\Models\Map;
use App\Models\Prestasi;

class HomeController extends Controller
{
    public function index()
    {
        $data = StrukturModel::all();
        $images = GaleriModel::all();
        $siswa = SiswaModel::all(); // Tambahkan ini untuk mengambil data siswa
        $alumni = Alumni::all(); // Tambahkan ini untuk mengambil data alumni

        $countSiswa = SiswaModel::where('kelas', '!=', 'alumni')->count(); // Tambahkan ini untuk menghitung jumlah siswa
        $countPrestasi = Prestasi::count(); // Tambahkan ini untuk menghitung jumlah prestasi

        $rumah = Map::with('siswa')->get();

        return view('view.home', ['data' => $data, 'images' => $images, 'siswa' => $siswa, 'alumni' => $alumni, 'totalSiswa' => $countSiswa, 'totalPrestasi' => $countPrestasi, 'rumah' => $rumah]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
