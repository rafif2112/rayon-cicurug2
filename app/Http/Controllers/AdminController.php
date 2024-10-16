<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaModel;
use App\Models\GaleriModel;
use App\Models\StrukturModel;
use App\Models\KegiatanModel;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = SiswaModel::count();
        $totalGaleri = GaleriModel::count();
        $totalStruktur = StrukturModel::count();
        $totalKegiatan = KegiatanModel::count();

        $totalKelas10 = SiswaModel::where('kelas', 10)->count();
        $totalKelas11 = SiswaModel::where('kelas', 11)->count();
        $totalKelas12 = SiswaModel::where('kelas', 12)->count();

        return view('admin.dashboard', [
            'totalKelas10' => $totalKelas10,
            'totalKelas11' => $totalKelas11,
            'totalKelas12' => $totalKelas12,
            
            'totalSiswa' => $totalSiswa,
            'totalGaleri' => $totalGaleri,
            'totalStruktur' => $totalStruktur,
            'totalKegiatan' => $totalKegiatan,
        ]);
    }
    
    public function index()
    {
        //
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

    /**
     * Naikkan kelas semua siswa.
     */
    public function naikKelas()
    {
        // Naikkan kelas semua siswa
        SiswaModel::where('kelas', '<', 13)->increment('kelas');
        
        // Ubah kelas 13 menjadi alumni
        SiswaModel::where('kelas', 13)->update(['kelas' => 'alumni']);
        
        return redirect()->route('dashboard')->with('success', 'Semua siswa telah naik kelas.');
    }
}