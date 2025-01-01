<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'Ahmad Hidayat',
                'nis' => '123456',
                'nisn' => '987654321',
                'jk' => 'Laki-Laki',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Siti Rahma',
                'nis' => '123457',
                'nisn' => '987654322',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Dedi Suryadi',
                'nis' => '123458',
                'nisn' => '987654323',
                'jk' => 'Laki-Laki',
                'status' => 'mutasi',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Fitri Ayu',
                'nis' => '123459',
                'nisn' => null,
                'jk' => 'Perempuan',
                'status' => 'berhenti',
                'foto' => 'Default Foto',
            ],
        ];

        DB::table('tb_siswa')->insert($data);
    }
}
