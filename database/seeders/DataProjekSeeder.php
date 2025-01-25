<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataProjekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_data_projek')->insert([
            [
                'tema' => 'Kearifan Lokal',
                'nama' => 'Membuat Barang Tradisional dari Sampah',
                'deskripsi' => 'Id nihil perspiciati Membuat Barang Tradisional da...',
                'created_at' => '2025-01-23 21:26:47',
                'updated_at' => '2025-01-24 07:28:55',
            ],
            [
                'tema' => 'Suara Demokrasi',
                'nama' => 'Est porro dolor null',
                'deskripsi' => 'Velit a esse ut dolo',
                'created_at' => '2025-01-23 21:26:55',
                'updated_at' => '2025-01-23 21:29:10',
            ],
            [
                'tema' => 'Bhineka Tunggal Ika',
                'nama' => 'Ipsam in deleniti qu',
                'deskripsi' => 'Laborum Et inventor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
