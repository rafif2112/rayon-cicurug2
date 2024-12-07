<?php

namespace App\Imports;

use App\Models\SiswaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataSiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SiswaModel([
            'nama' => $row['nama'],
            'kelas' => $row['kelas'],
            'angkatan' => $row['angkatan'],
            'gambar' => $row['gambar'],
            'jurusan' => $row['jurusan'],
            'nis' => $row['nis'],
        ]);
    }
}
