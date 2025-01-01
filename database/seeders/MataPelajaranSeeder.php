<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_mata_pelajaran' => 'IPA', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'IPS', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'MTK', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'SEJARAH', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'KIMIA', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'SBK', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'PENJASKES', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'BIOLOGI', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'FISIKA', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'INFORMATIKA', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'IPA', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'IPS', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'MTK', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'SEJARAH', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'KIMIA', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'SBK', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'PENJASKES', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'BIOLOGI', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'FISIKA', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'INFORMATIKA', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'IPA', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'IPS', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'MTK', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'SEJARAH', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'KIMIA', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'SBK', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'PENJASKES', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'BIOLOGI', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'FISIKA', 'kelompok' => 'C'],
            ['nama_mata_pelajaran' => 'INFORMATIKA', 'kelompok' => 'C'],
        ];

        DB::table('tb_mata_pelajaran')->insert($data);
    }
}
