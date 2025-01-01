<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_profil_sekolah')->insert([
            'nama_sekolah' => 'SD Negeri 2 Air Deras',
            'akreditas' => 'A',
            'npsn' => '12345678',
            'alamat' => 'Jl. Pendidikan No. 10, Air Deras',
            'kode_pos' => '12345',
            'telepon' => '0211234567',
            'email' => 'info@sdn2airderas.sch.id',
            'nama_kepsek' => 'Gusma Nelti, S.Pd',
            'nip_kepsek' => '19630515 199003 2 001',
            'pangkat_golongan_kepsek' => 'IV/A - Pembina Utama',
            'ttd_tempat_tanggal_rapot' => 'Palembang, 25 Desember 2024',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
