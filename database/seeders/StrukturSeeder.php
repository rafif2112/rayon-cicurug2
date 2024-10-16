<?php

namespace Database\Seeders;

use App\Models\StrukturModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrukturSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ardi Ariansyah',
                'jabatan' => 'Pembimbing Siswa',
                'gambar' => 'image.jpg'
            ],
            [
                'nama' => 'Muhamad Rafif',
                'jabatan' => 'Ketua Rayon',
                'gambar' => 'rafif.jpg'
            ],
            [
                'nama' => 'Muhamad Rafif',
                'jabatan' => 'Wakil Ketua Rayon',
                'gambar' => 'image.jpg'
            ],
            [
                'nama' => 'Muhamad Rafif',
                'jabatan' => 'Sekertaris 1',
                'gambar' => 'image.jpg'
            ],
            [
                'nama' => 'Muhamad Rafif',
                'jabatan' => 'Bendahara 1',
                'gambar' => 'image.jpg'
            ],
            [
                'nama' => 'Muhamad Rafif',
                'jabatan' => 'Sekertaris 2',
                'gambar' => 'image.jpg'
            ],
            [
                'nama' => 'Muhamad Rafif',
                'jabatan' => 'Bendaraha 2',
                'gambar' => 'image.jpg'
            ],
        ];

        foreach ($data as $struktur) {
            StrukturModel::create($struktur);
        }
    }
}
