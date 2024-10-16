<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Alumni extends Seeder
{
    public function run(): void
    {
        $alumni = [
            [
                'gambar' => 'image.jpg',
                'nama' => 'Siti Nurhaliza',
                'jurusan' => 'IPA',
                'angkatan' => '15',
                'tempat_bekerja' => 'PT. Sejahtera',
                'pekerjaan' => 'Supervisor',
            ],
            [
                'gambar' => 'image.jpg',
                'nama' => 'Budi Santoso',
                'jurusan' => 'IPS',
                'angkatan' => '10',
                'tempat_bekerja' => 'PT. Makmur',
                'pekerjaan' => 'Staff',
            ],
            [
                'gambar' => 'image.jpg',
                'nama' => 'Rina Sari',
                'jurusan' => 'IPA',
                'angkatan' => '8',
                'tempat_bekerja' => 'PT. Sukses',
                'pekerjaan' => 'Analyst',
            ],
            [
                'gambar' => 'image.jpg',
                'nama' => 'Agus Salim',
                'jurusan' => 'IPS',
                'angkatan' => '5',
                'tempat_bekerja' => 'PT. Jaya Abadi',
                'pekerjaan' => 'Consultant',
            ],
        ];

        foreach ($alumni as $data) {
            \App\Models\Alumni::create($data);
        }
    }
}
