<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = 'siswa_models';
    protected $fillable = ['nama', 'kelas', 'gambar', 'jurusan', 'nis', 'angkatan'];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}