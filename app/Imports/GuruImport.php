<?php

namespace App\Imports;

use Throwable;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return DB::transaction(function () use ($row) {
            // Validasi data input
            if (empty($row['email'])) {
                throw new \Exception("Kolom email tidak boleh kosong untuk guru: " . $row['nama']);
            }
        
            // Buat data user terlebih dahulu
            $user = User::create([
                'name'     => $row['nama'],
                'email'    => $row['email'],
                'password' => Hash::make('guru'), // Default password
            ]);
        
            // Berikan role pada user
            $user->assignRole('walas');
        
            // Buat data guru dan hubungkan dengan user
            $guru = Guru::create([
                'id_user'             => $user->id,
                'nama'                => $row['nama'],
                'nip'                 => $row['nip'] ?? null,
                'nrg'                 => $row['nrg'] ?? null,
                'jk'                  => $row['jk'],
                'tempat_lahir'        => $row['tempat_lahir'] ?? null,
                'tgl_lahir'           => $row['tgl_lahir'] ?? null,
                'agama'               => $row['agama'] ?? null,
                'alamat'              => $row['alamat'] ?? null,
                'no_hp'               => $row['no_hp'] ?? null,
                'jabatan'             => $row['jabatan'] ?? null,
                'golongan'            => $row['golongan'] ?? null,
                'tmt_awal'            => $row['tmt_awal'] ?? null,
                'pendidikan_terakhir' => $row['pendidikan_terakhir'] ?? null,
                'status'              => 'Aktif',
                'foto'                => null, // Foto tidak diupload melalui import
            ]);
        
            return $guru;
        });
    }
    public function headingRow():int{
        return 1;
    }

    public function onError(\Throwable $e)
    {
        
    }
}
