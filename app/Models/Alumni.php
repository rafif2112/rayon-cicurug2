<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = ['gambar','nama', 'jurusan', 'angkatan', 'tempat_bekerja', 'pekerjaan'];
}
