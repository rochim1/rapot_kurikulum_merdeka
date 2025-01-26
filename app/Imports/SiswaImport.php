<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11])) {
            return null;
        }

        return new Siswa([
            'nama' => $row[0],
            'nis' => $row[1],
            'nisn' => $row[2],
            'tempat_lahir' => $row[3],
            'tanggal_lahir' => $row[4],
            'jk' => $row[5],
            'agama' => $row[6],
            'nama_ayah' => $row[7],
            'nama_ibu' => $row[8],
            'no_telp_ortu' => $row[9],
            'alamat' => $row[10],
            'status' => $row[11],
        ]);
    }
}
