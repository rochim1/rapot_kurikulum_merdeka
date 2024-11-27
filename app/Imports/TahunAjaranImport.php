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
        return new TahunAjaran([
            'nama_tahun_ajaran' => $row[0],
        ]);
    }
}
