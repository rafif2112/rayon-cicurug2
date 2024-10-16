<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiswaModel;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = [
            ['nama' => 'Muhamad Rafif', 'kelas' => '11', 'jurusan' => 'PPLG', 'gambar' => 'rafif.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Muhamad Sopian Hadi', 'kelas' => '11', 'jurusan' => 'DKV', 'gambar' => 'sopian.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Deni Agus Prianto', 'kelas' => '11', 'jurusan' => 'DKV', 'gambar' => 'deni.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Safa Fadilah', 'kelas' => '11', 'jurusan' => 'PPLG', 'gambar' => 'safa.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Hasna Hafidzah', 'kelas' => '11', 'jurusan' => 'DKV', 'gambar' => 'hasna.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Zahra Kamila', 'kelas' => '11', 'jurusan' => 'PPLG', 'gambar' => 'kamil.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Zahra Ayu', 'kelas' => '11', 'jurusan' => 'PMN', 'gambar' => 'ayu.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Salzabil Zahra', 'kelas' => '11', 'jurusan' => 'MPLB', 'gambar' => 'salza.jpg', 'nis' => '12309793', 'angkatan' => '28'],
            ['nama' => 'Ambiya Pasadena', 'kelas' => '11', 'jurusan' => 'TJKT', 'gambar' => 'ambiya.jpg', 'nis' => '12309793', 'angkatan' => '28'],

            ['nama' => 'Muhamad Rafif', 'kelas' => '10', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '29'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '10', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '29'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '10', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '29'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '10', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '29'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '10', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '29'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '10', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '29'],

            ['nama' => 'Muhamad Rafif', 'kelas' => '12', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '27'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '12', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '27'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '12', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '27'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '12', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '27'],
            ['nama' => 'Muhamad Rafif', 'kelas' => '12', 'jurusan' => 'PPLG', 'gambar' => 'image.jpg', 'nis' => '12345678', 'angkatan' => '27'],
        ];

        foreach ($siswa as $sw) {
            SiswaModel::create($sw);
        }
    }
}
