<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class SiswaImport implements ToModel, WithHeadingRow
{
    private $rowCount = 0; // Track the number of rows processed

    public function model(array $row)
    {
        // Check if required columns exist
        $requiredColumns = ['nama', 'nis', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jk', 'agama', 'nama_ayah', 'nama_ibu', 'no_telp_ortu', 'alamat', 'status'];
        
        foreach ($requiredColumns as $column) {
            if (!isset($row[$column]) || empty($row[$column])) {
                return null; // Skip rows with missing data
            }
        }
        // Insert data using Query Builder, nyoba pakai query builder 
        $import = DB::table('tb_siswa')->insert([
            'nama' => $row['nama'],
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $this->transformDate($row['tanggal_lahir']), // Transform date if necessary
            'jk' => $row['jk'],
            'agama' => $row['agama'],
            'nama_ayah' => $row['nama_ayah'],
            'nama_ibu' => $row['nama_ibu'],
            'no_telp_ortu' => $row['no_telp_ortu'],
            'alamat' => $row['alamat'],
            'status' => $row['status'] ?? 'active',
        ]);
        
        $this->rowCount++; // Increment the row count
    }

    public function getRowCount()
    {
        return $this->rowCount; // Return the row count
    }

    private function transformDate($date)
    {
        if (is_numeric($date)) {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date))->format('Y-m-d');
        }

        $formats = ['d/m/Y', 'Y-m-d', 'm/d/Y']; // List of possible date formats
        foreach ($formats as $format) {
            try {
                // Attempt to parse the date using the current format
                return \Carbon\Carbon::createFromFormat($format, $date)->format('Y-m-d');
            } catch (\Exception $e) {
                // Log a debug message for the failed attempt
                // \Log::debug("Failed to parse date '{$date}' with format '{$format}': " . $e->getMessage());
            }
        }

        // Log a warning if all formats fail
        // \Log::warning("Unrecognized date format: '{$date}'");

        return null; // Return null if none of the formats match
    }


}
