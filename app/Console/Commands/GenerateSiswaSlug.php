<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SiswaModel;

class GenerateSiswaSlug extends Command
{
    protected $signature = 'siswa:generate-slug';
    protected $description = 'Generate slug for existing siswa data';

    public function handle()
    {
        $siswaList = SiswaModel::whereNull('slug')->orWhere('slug', '')->get();
        
        foreach ($siswaList as $siswa) {
            $siswa->slug = SiswaModel::generateSlug($siswa->nama);
            $siswa->save();
            $this->info("Generated slug for: {$siswa->nama} -> {$siswa->slug}");
        }

        $this->info('Slug generation completed!');
    }
}