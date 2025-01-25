<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompokProjekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_kelompok_projek')->insert([
            [
                'nama' => 'Kewirausahaan 1.A',
                'id_tahun_ajaran' => 1,
                'id_kelas' => 1,
                'id_user' => 3,
                'created_at' => '2025-01-23 21:30:55',
                'updated_at' => '2025-01-24 08:27:31',
            ],
            [
                'nama' => 'Kewirausahaan 2.A',
                'id_tahun_ajaran' => 1,
                'id_kelas' => 1,
                'id_user' => 4,
                'created_at' => '2025-01-24 08:26:59',
                'updated_at' => '2025-01-24 08:28:51',
            ],
        ]);
    }
}
