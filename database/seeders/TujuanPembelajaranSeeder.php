<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TujuanPembelajaranSeeder extends Seeder
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
                'id_mata_pelajaran' => 1, // ID Mata Pelajaran IPA
                'id_kelas' => 1,          // ID Kelas 7A
                'tujuan_pembelajaran' => 'Memahami konsep dasar ekosistem dan interaksi antara makhluk hidup.',
                'tujuan_pembelajaran_tercapai' => 'Siswa mampu Memahami konsep dasar ekosistem dan interaksi antara makhluk hidup.',
                'tujuan_pembelajaran_tidak_tercapai' => 'Siswa tidak mampu kesulitan Memahami konsep dasar ekosistem dan interaksi antara makhluk hidup.',
                'is_active' => true,
            ],
            [
                'id_mata_pelajaran' => 2, // ID Mata Pelajaran IPS
                'id_kelas' => 2,          // ID Kelas 8B
                'tujuan_pembelajaran' => 'Menganalisis perubahan sosial dalam masyarakat modern.',
                'tujuan_pembelajaran_tercapai' => 'Siswa mampu Menganalisis perubahan sosial dalam masyarakat modern.',
                'tujuan_pembelajaran_tidak_tercapai' => 'Siswa tidak mampu Menganalisis perubahan sosial dalam masyarakat modern.',
                'is_active' => true,
            ],
            [
                'id_mata_pelajaran' => 3, // ID Mata Pelajaran Matematika
                'id_kelas' => 3,          // ID Kelas 9C
                'tujuan_pembelajaran' => 'Menyelesaikan masalah yang melibatkan persamaan linear dua variabel.',
                'tujuan_pembelajaran_tercapai' => 'Siswa mampu Menyelesaikan masalah yang melibatkan persamaan linear dua variabel.',
                'tujuan_pembelajaran_tidak_tercapai' => 'Siswa tidak mampu Menyelesaikan masalah yang melibatkan persamaan linear dua variabel.',
                'is_active' => true,
            ],
            [
                'id_mata_pelajaran' => 4, // ID Mata Pelajaran Sejarah
                'id_kelas' => 1,          // ID Kelas 7A
                'tujuan_pembelajaran' => 'Mengidentifikasi peristiwa sejarah penting di Indonesia.',
                'tujuan_pembelajaran_tercapai' => 'Siswa mampu Mengidentifikasi peristiwa sejarah penting di Indonesia.',
                'tujuan_pembelajaran_tidak_tercapai' => 'Siswa tidak mampu Mengidentifikasi peristiwa sejarah penting di Indonesia.',
                'is_active' => false,
            ],
        ];

        DB::table('tb_tujuan_pembelajaran')->insert($data);
    }
}
