<?php

namespace App\Imports;

use App\Models\Rapor;
use Maatwebsite\Excel\Concerns\ToModel;

class RaporImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rapor([
            //'nama' => $row[0],
        ]);
    }
}
