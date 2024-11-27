<?php

namespace App\Imports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;

class KelasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kelas([
            'id_guru' => $row[0],
            'id_tahun_ajaran' => $row[1],
            'nama_kelas' => $row[2],
            'tingkat' => $row[3],
            'fase' => $row[4],
        ]);
    }
}
