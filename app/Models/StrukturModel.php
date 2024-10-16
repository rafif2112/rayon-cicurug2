<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturModel extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan', 'gambar'];
}
