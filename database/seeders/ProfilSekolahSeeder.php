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
            'nama_sekolah' => 'SD Negeri Nusa Bali',
            'akreditas' => 'B',
            'npsn' => '10606403',
            'alamat' => 'Jalan Raya Nusa Bali, Kecamatan Belitang 3, Kabupaten Oku Timur, Provinsi Sumatera Selatan',
            'kode_pos' => '32385',
            'telepon' => '085737476316',
            'email' => 'sdn.nusabali10606403@gmail.com',
            'nama_kepsek' => 'Muhamad Dahroni, S.Pd., SD',
            'nip_kepsek' => '196705252006041002',
            'pangkat_golongan_kepsek' => '-',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
