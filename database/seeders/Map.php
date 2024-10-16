<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Map extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rumah = [
            [
                'nama' => 'Muhamad Rafif',
                'angkatan' => '28',
                'latitude' => -6.6909762,
                'longitude' => 106.8515798
            ],
            [
                'nama' => 'Deni Agus Prianto',
                'angkatan' => '28',
                'latitude' => -6.691474,
                'longitude' => 106.8500183
            ],
            [
                'nama' => 'Rizky Ramadhan',
                'angkatan' => '27',
                'latitude' => -6.6918833,
                'longitude' => 106.8499948
            ],
        ];

        foreach ($rumah as $home) {
            \App\Models\Map::create($home);
        }
    }
}
