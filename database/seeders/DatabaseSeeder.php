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
            MataPelajaranSeeder::class,
            SiswaSeeder::class,
            TahunAjaranSeeder::class,
            KelasSeeder::class,
            TujuanPembelajaranSeeder::class,
            EkstrakulikulerSeeder::class,
            ProfilSekolahSeeder::class,
            ProfilSekolahSeeder::class,
            TargetCapaianSeeder::class,
            DataProjekSeeder::class,
            DataProjekTargetCapaianSeeder::class,
            // KelompokProjekSeeder::class,
            // KelompokProjekDataProjekSeeder::class,
        ]);
    }
}
