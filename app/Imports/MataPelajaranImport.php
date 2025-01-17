<?php

namespace App\Imports;

use App\Models\MataPelajaran;
use Maatwebsite\Excel\Concerns\ToModel;

class MataPelajaranImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[0], $row[1])) {
            return null;
        }

        return new MataPelajaran([
            'nama_mata_pelajaran' => $row[0],
            'kelompok' => $row[1],
        ]);
    }
}
