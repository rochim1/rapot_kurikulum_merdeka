<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
            ProfilSekolahSeeder::class,
            EkstrakulikulerSeeder::class,
            TahunAjaranSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            MataPelajaranSeeder::class,
            // GuruSeeder::class,
            TujuanPembelajaranSeeder::class,
        ]);
    }
}
