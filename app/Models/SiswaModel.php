<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = 'siswa_models';
    protected $fillable = ['nama', 'kelas', 'gambar', 'jurusan', 'nis', 'angkatan', 'deskripsi', 'sertifikat', 'skill', 'pengalaman', 'kontak'];

    protected $casts = [
        'sertifikat' => 'array',
        'skill' => 'array',
        'pengalaman' => 'array',
        'kontak' => 'array',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'siswa_id');
    }

    public static function generateSlug($nama)
    {
        $slug = Str::slug($nama);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($siswa) {
            if (empty($siswa->slug)) {
                $siswa->slug = static::generateSlug($siswa->nama);
            }
        });

        static::updating(function ($siswa) {
            if ($siswa->isDirty('nama')) {
                $siswa->slug = static::generateSlug($siswa->nama);
            }
        });
    }
}