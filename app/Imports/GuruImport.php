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
            $guru = Guru::Create([
            'mata_pelajaran_id'   => $row['mata_pelajaran_id'],
            'nama'                => $row['nama'],
            'nip'                 => $row['nip'],
            'nrg'                 => $row['nrg'],
            'jk'                  => $row['jk'],
            'tempat_lahir'        => $row['tempat_lahir'],
            'tgl_lahir'           => $row['tgl_lahir'],
            'agama'               => $row['agama'],
            'alamat'              => $row['alamat'],
            'no_hp'               => $row['no_hp'],
            'jabatan'             => $row['jabatan'],
            'golongan'            => $row['golongan'],
            'tmt_awal'            => $row['tmt_awal'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            ]);
            // Membuat data user
            $email = strtolower(str_replace(' ', '.', $guru->nama)) . '@gmail.com';
            $user = User::create([
                'name'     => $guru->nama,
                'email'    => $email,
                'password' => Hash::make('guru'),
            ]);

            // Menambahkan role untuk user
            $role = Role::firstOrCreate(['name' => 'walas']);
            $user->assignRole($role);

            // Mengupdate data guru dengan id_user
            $guru->update(['id_user' => $user->id]);
        });
    }

    public function headingRow():int{
        return 1;
    }

    public function onError(\Throwable $e)
    {
        
    }
}
