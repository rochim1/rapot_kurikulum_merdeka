<?php

namespace App\Imports;

use App\Models\TahunAjaran;
use Maatwebsite\Excel\Concerns\ToModel;

class TahunAjaranImport implements ToModel
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

        return new TahunAjaran([
            'tahun_ajaran_awal' => $row[0], 
            'tahun_ajaran_akhir' => $row[1], 
            'semester' => $row[2], 
            'is_active' => $row[3],
        ]);
    }
}
