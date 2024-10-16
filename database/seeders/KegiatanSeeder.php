<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\KegiatanModel;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatan = [
            ['judul' => 'Kegiatan 1', 'gambar' => 'kegiatan-1.jpg', 'deskripsi' => 'Deskripsi kegiatan 1'],
            ['judul' => 'Kegiatan 2', 'gambar' => 'kegiatan-2.jpg', 'deskripsi' => 'Deskripsi kegiatan 2'],
            ['judul' => 'Kegiatan 3', 'gambar' => 'kegiatan-3.jpg', 'deskripsi' => 'Deskripsi kegiatan 3'],
            ['judul' => 'Kegiatan 4', 'gambar' => 'kegiatan-4.jpg', 'deskripsi' => 'Deskripsi kegiatan 4'],
        ];
        foreach ($kegiatan as $keg) {
            KegiatanModel::create($keg);
        }
    }
}
