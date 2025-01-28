<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkstrakulikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_ekstrakulikuler' => 'Basket'],
            ['nama_ekstrakulikuler' => 'Volleyball'],
            ['nama_ekstrakulikuler' => 'Sepak Bola'],
            ['nama_ekstrakulikuler' => 'Pencak Silat'],
            ['nama_ekstrakulikuler' => 'Pramuka'],
            // Tambahkan data ekstrakulikuler lainnya sesuai kebutuhan
        ];

        DB::table('tb_ekstrakulikuler')->insert($data);
    }
}
