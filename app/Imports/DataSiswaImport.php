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
        return SiswaModel::updateOrCreate(
            ['nis' => $row['nis']],
            [
                'nama' => $row['nama'],
                'kelas' => $row['kelas'],
                'angkatan' => $row['angkatan'],
                'jurusan' => $row['jurusan'],
            ]
        );
    }
}
