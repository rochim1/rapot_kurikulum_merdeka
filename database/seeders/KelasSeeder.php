<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kelas_tingkatan' => 'I', 'kelas_abjad' => 'A', 'fase' => 'A'],
            ['kelas_tingkatan' => 'I', 'kelas_abjad' => 'B', 'fase' => 'A'],
            ['kelas_tingkatan' => 'II', 'kelas_abjad' => 'A', 'fase' => 'A'],
            ['kelas_tingkatan' => 'II', 'kelas_abjad' => 'B', 'fase' => 'A'],
            ['kelas_tingkatan' => 'III', 'kelas_abjad' => 'A', 'fase' => 'B'],
            ['kelas_tingkatan' => 'III', 'kelas_abjad' => 'B', 'fase' => 'B'],
            ['kelas_tingkatan' => 'IV', 'kelas_abjad' => 'A', 'fase' => 'B'],
            ['kelas_tingkatan' => 'IV', 'kelas_abjad' => 'B', 'fase' => 'B'],
            ['kelas_tingkatan' => 'V', 'kelas_abjad' => 'A', 'fase' => 'C'],
            ['kelas_tingkatan' => 'V', 'kelas_abjad' => 'B', 'fase' => 'C'],
            ['kelas_tingkatan' => 'VI', 'kelas_abjad' => 'A', 'fase' => 'C'],
            ['kelas_tingkatan' => 'VI', 'kelas_abjad' => 'B', 'fase' => 'C'],
        ];

        DB::table('tb_kelas')->insert($data);
    }
}
