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
            EkstrakulikulerSeeder::class,
            GuruSeeder::class,
            KelasSeeder::class,
            MataPelajaranSeeder::class,
            SiswaSeeder::class,
            TahunAjaranSeeder::class,
        ]);
    }
}
