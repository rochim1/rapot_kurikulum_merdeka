<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
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
                'tahun_ajaran_awal' => 2023,
                'tahun_ajaran_akhir' => 2024,
                'semester' => 'Genap',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2023,
                'tahun_ajaran_akhir' => 2024,
                'semester' => 'Ganjil',
                'is_active' => true,
            ],
            [
                'tahun_ajaran_awal' => 2022,
                'tahun_ajaran_akhir' => 2023,
                'semester' => 'Genap',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2022,
                'tahun_ajaran_akhir' => 2023,
                'semester' => 'Ganjil',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2021,
                'tahun_ajaran_akhir' => 2022,
                'semester' => 'Genap',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2021,
                'tahun_ajaran_akhir' => 2022,
                'semester' => 'Ganjil',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2020,
                'tahun_ajaran_akhir' => 2021,
                'semester' => 'Genap',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2020,
                'tahun_ajaran_akhir' => 2021,
                'semester' => 'Ganjil',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2019,
                'tahun_ajaran_akhir' => 2020,
                'semester' => 'Genap',
                'is_active' => false,
            ],
            [
                'tahun_ajaran_awal' => 2019,
                'tahun_ajaran_akhir' => 2020,
                'semester' => 'Ganjil',
                'is_active' => false,
            ],
        ];

        DB::table('tb_tahun_ajaran')->insert($data);
    }
}
