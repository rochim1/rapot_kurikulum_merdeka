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
            [
                'nama' => 'Rina Safitri',
                'nis' => '123460',
                'nisn' => '987654324',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Fahmi Hidayat',
                'nis' => '123461',
                'nisn' => '987654325',
                'jk' => 'Laki-Laki',
                'status' => 'mutasi',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Dian Widiarti',
                'nis' => '123462',
                'nisn' => '987654326',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Agus Saputra',
                'nis' => '123463',
                'nisn' => null,
                'jk' => 'Laki-Laki',
                'status' => 'berhenti',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Lina Marlina',
                'nis' => '123464',
                'nisn' => '987654327',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Rafi Ahmad',
                'nis' => '123465',
                'nisn' => '987654328',
                'jk' => 'Laki-Laki',
                'status' => 'lulus',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Yuniarti Sari',
                'nis' => '123466',
                'nisn' => '987654329',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Eko Prasetyo',
                'nis' => '123467',
                'nisn' => '987654330',
                'jk' => 'Laki-Laki',
                'status' => 'mutasi',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Indah Lestari',
                'nis' => '123468',
                'nisn' => '987654331',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Reza Saputra',
                'nis' => '123469',
                'nisn' => '987654332',
                'jk' => 'Laki-Laki',
                'status' => 'berhenti',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Citra Anggraini',
                'nis' => '123470',
                'nisn' => '987654333',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Andi Wirawan',
                'nis' => '123471',
                'nisn' => '987654334',
                'jk' => 'Laki-Laki',
                'status' => 'lulus',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Vina Aulia',
                'nis' => '123472',
                'nisn' => '987654335',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Hendra Gunawan',
                'nis' => '123473',
                'nisn' => '987654336',
                'jk' => 'Laki-Laki',
                'status' => 'mutasi',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Liana Dewi',
                'nis' => '123474',
                'nisn' => '987654337',
                'jk' => 'Perempuan',
                'status' => 'active',
                'foto' => 'Default Foto',
            ],
            [
                'nama' => 'Budi Santoso',
                'nis' => '123475',
                'nisn' => '987654338',
                'jk' => 'Laki-Laki',
                'status' => 'berhenti',
                'foto' => 'Default Foto',
            ],
        ];

        DB::table('tb_siswa')->insert($data);
    }
}
