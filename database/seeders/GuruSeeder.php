<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
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
                'id_user' => 1,
                'mata_pelajaran_id' => 1,
                'nama' => 'Ahmad Hidayat',
                'nip' => '1234567890',
                'nrg' => '987654321',
                'jk' => 'Laki-Laki',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1985-05-20',
                'agama' => 'Islam',
                'alamat' => 'Jl. Raya No. 12, Bandung',
                'no_hp' => '081234567890',
                'email' => '081234567890@gmail.com',
                'jabatan' => 'Guru Matematika',
                'golongan' => 'III/A',
                'tmt_awal' => '2010-06-01',
                'pendidikan_terakhir' => 'S1 Pendidikan Matematika',
                'status' => 'Aktif',
                'is_wali_kelas' => true,
                'foto' => 'ahmad_hidayat.jpg',
            ],
            [
                'id_user' => 2,
                'mata_pelajaran_id' => 2,
                'nama' => 'Siti Rahma',
                'nip' => '1234578901',
                'nrg' => '987654322',
                'jk' => 'Perempuan',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1988-08-15',
                'agama' => 'Islam',
                'alamat' => 'Jl. Merdeka No. 15, Jakarta',
                'no_hp' => '081234567891',
                'email' => '081234567891@gmail.com',
                'jabatan' => 'Guru Bahasa Indonesia',
                'golongan' => 'II/B',
                'tmt_awal' => '2012-07-10',
                'pendidikan_terakhir' => 'S1 Pendidikan Bahasa Indonesia',
                'status' => 'Aktif',
                'is_wali_kelas' => false,
                'foto' => 'siti_rahma.jpg',
            ],
            // Tambahkan data guru lainnya sesuai kebutuhan
        ];

        DB::table('tb_guru')->insert($data);
    }
}
