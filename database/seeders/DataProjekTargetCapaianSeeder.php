<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataProjekTargetCapaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_data_projek_target_capaian')->insert([
            [
                'id_data_projek_target_capaian' => 2,
                'id_data_projek' => 2,
                'id_target_capaian' => 9,
                'created_at' => '2025-01-23 21:29:22',
                'updated_at' => '2025-01-23 21:29:22',
            ],
            [
                'id_data_projek_target_capaian' => 5,
                'id_data_projek' => 1,
                'id_target_capaian' => 1,
                'created_at' => '2025-01-24 07:37:03',
                'updated_at' => '2025-01-24 07:37:03',
            ],
            [
                'id_data_projek_target_capaian' => 6,
                'id_data_projek' => 1,
                'id_target_capaian' => 5,
                'created_at' => '2025-01-24 07:37:13',
                'updated_at' => '2025-01-24 07:37:13',
            ],
            [
                'id_data_projek_target_capaian' => 7,
                'id_data_projek' => 1,
                'id_target_capaian' => 9,
                'created_at' => '2025-01-24 07:37:18',
                'updated_at' => '2025-01-24 07:37:18',
            ],
            [
                'id_data_projek_target_capaian' => 8,
                'id_data_projek' => 1,
                'id_target_capaian' => 11,
                'created_at' => '2025-01-24 07:37:24',
                'updated_at' => '2025-01-24 07:37:24',
            ],
        ]);
        
    }
}
