<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompokProjekDataProjekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_kelompok_projek_data_projek')->insert([
            [
                'id_kelompok_projek' => 1,
                'id_data_projek' => 1,
                'created_at' => '2025-01-23 23:04:12',
                'updated_at' => '2025-01-23 23:04:12',
            ],
            [
                'id_kelompok_projek' => 2,
                'id_data_projek' => 1,
                'created_at' => '2025-01-24 08:29:05',
                'updated_at' => '2025-01-24 08:29:05',
            ],
            [
                'id_kelompok_projek' => 2,
                'id_data_projek' => 2,
                'created_at' => '2025-01-24 08:29:11',
                'updated_at' => '2025-01-24 08:29:11',
            ],
            [
                'id_kelompok_projek' => 2,
                'id_data_projek' => 3,
                'created_at' => '2025-01-24 08:29:18',
                'updated_at' => '2025-01-24 08:29:18',
            ],
        ]);
    }
}
