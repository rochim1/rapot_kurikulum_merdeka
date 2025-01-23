<?php

namespace App\Imports;

use App\Models\TargetCapaian;
use Maatwebsite\Excel\Concerns\ToModel;

class TargetCapaianImport implements ToModel
{
    public function model(array $row)
    {
        if (!isset($row[0], $row[1], $row[2], $row[3])) {
            return null;
        }

        return new TargetCapaian([
            'dimensi' => $row[0],
            'elemen' => $row[1],
            'sub_elemen' => $row[2],
            'capaian_akhir_fase' => $row[3],
        ]);
    }
}
