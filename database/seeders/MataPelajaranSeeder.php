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
            ['nama_mata_pelajaran' => 'Pendidikan agama dan budi pekerti', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'Pendidikan Pancasila', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'Bahasa indonesia', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'Matematika', 'kelompok' => 'A'],
            ['nama_mata_pelajaran' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'kelompok' => 'A'],

            ['nama_mata_pelajaran' => 'Seni Musik', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'Seni Tari', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'Seni Rupa', 'kelompok' => 'B'],
            ['nama_mata_pelajaran' => 'Seni Teater', 'kelompok' => 'B'],

            ['nama_mata_pelajaran' => 'Mulok Budaya Komering', 'kelompok' => 'C'],
        ];

        DB::table('tb_mata_pelajaran')->insert($data);
    }
}
