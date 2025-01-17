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
        if (!isset($row[0], $row[1], $row[2])) {
            return null;
        }

        return new Kelas([
            'kelas_tingkatan' => $row[0],
            'kelas_abjad' => $row[1],
            'fase' => $row[2],
        ]);
    }
}
