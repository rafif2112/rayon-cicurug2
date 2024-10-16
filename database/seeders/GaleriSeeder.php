<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GaleriModel;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $image = [
            ['gambar' => 'kelas-10.jpeg', 'judul' => 'Kelas 10'],
            ['gambar' => 'jumsih.jpg', 'judul' => 'Jumat Bersih'],
            ['gambar' => 'doc-3.jpg', 'judul' => 'Dokumentasi 3'],
            ['gambar' => 'doc-4.jpg', 'judul' => 'Dokumentasi 4'],
        ];

        foreach ($image as $img) {
            GaleriModel::create($img);
        }
    }
}