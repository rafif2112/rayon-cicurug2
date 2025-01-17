<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'username' => 'rayoncicurug2',
        //     'email' => 'adminrayoncic2@tes',
        //     'password' => Hash::make('adminrayoncic2'),
        // ]);

        User::create([
            'username' => 'admin',
            'email' => 'admin@tes',
            'password' => Hash::make('admin'),
        ]);
    }
}