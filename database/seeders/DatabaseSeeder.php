<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SiswaSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StrukturSeeder::class,
            GaleriSeeder::class,
            KegiatanSeeder::class,
            SiswaSeeder::class,
            UserSeeder::class,
            Alumni::class,
            Map::class,
        ]);
    }
}
