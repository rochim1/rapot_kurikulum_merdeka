<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetCapaianSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'Keimanan dan Ketakwaan',
                'sub_elemen' => 'Penghayatan ajaran agama dan pengamalan ibadah',
                'capaian_akhir_fase' => 'Peserta didik menjalankan ibadah dengan baik, menjalankan ajaran agama dengan penuh kesungguhan, dan berakhlak mulia.',
            ],
            [
                'dimensi' => 'Akhlak Mulia',
                'elemen' => 'Perilaku berbudi pekerti luhur',
                'sub_elemen' => 'Peserta didik dapat berperilaku sesuai dengan ajaran agama, seperti jujur, sabar, dan berperilaku adil.',
                'capaian_akhir_fase' => '',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'Penghargaan terhadap Keberagaman',
                'sub_elemen' => 'Memahami dan menghargai perbedaan budaya, agama, suku, dan ras',
                'capaian_akhir_fase' => 'Peserta didik dapat hidup harmonis dengan keberagaman, menghormati perbedaan, dan memiliki sikap inklusif dalam berinteraksi.',
            ],
            [
                'dimensi' => 'Empati terhadap sesama',
                'elemen' => 'Menumbuhkan rasa empati dan solidaritas terhadap orang lain',
                'sub_elemen' => 'Peserta didik peduli terhadap kebutuhan orang lain dan menghargai keberagaman dalam masyarakat.',
                'capaian_akhir_fase' => '',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'Kerjasama dalam Kelompok',
                'sub_elemen' => 'Bekerja bersama dalam mencapai tujuan bersama',
                'capaian_akhir_fase' => 'Peserta didik aktif dalam berkolaborasi dan berbagi tanggung jawab dalam tugas kelompok.',
            ],
            [
                'dimensi' => 'Tanggung Jawab Sosial',
                'elemen' => 'Berperan aktif dalam kegiatan sosial dan membantu sesama',
                'sub_elemen' => 'Peserta didik terlibat dalam kegiatan sosial yang membantu orang lain, seperti kerja bakti atau kegiatan amal.',
                'capaian_akhir_fase' => '',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'Kemandirian dalam Belajar',
                'sub_elemen' => 'Mengambil inisiatif dan bertanggung jawab atas pembelajaran',
                'capaian_akhir_fase' => 'Peserta didik dapat menyelesaikan tugas secara mandiri dan bertanggung jawab dalam belajar.',
            ],
            [
                'dimensi' => 'Pengambilan Keputusan',
                'elemen' => 'Membuat keputusan secara mandiri dan penuh pertimbangan',
                'sub_elemen' => 'Peserta didik mampu membuat keputusan yang bijaksana dan bertanggung jawab atas keputusan yang diambil.',
                'capaian_akhir_fase' => '',
            ],
            [
                'dimensi' => 'Bernalar Kritis',
                'elemen' => 'Kemampuan Menganalisis',
                'sub_elemen' => 'Mengidentifikasi masalah dan mengevaluasi informasi dengan objektif',
                'capaian_akhir_fase' => 'Peserta didik mampu menganalisis masalah dengan kritis dan membuat keputusan berdasarkan analisis yang tepat.',
            ],
            [
                'dimensi' => 'Berpikir Logis dan Rasional',
                'elemen' => 'Menggunakan nalar yang logis dan objektif dalam menyelesaikan masalah',
                'sub_elemen' => 'Peserta didik dapat berpikir rasional, mengevaluasi berbagai perspektif, dan mencari solusi berdasarkan bukti dan fakta.',
                'capaian_akhir_fase' => '',
            ],
            [
                'dimensi' => 'Kreatif',
                'elemen' => 'Inovasi dan Ide Baru',
                'sub_elemen' => 'Menghasilkan ide-ide baru yang bermanfaat',
                'capaian_akhir_fase' => 'Peserta didik dapat berinovasi dan menghasilkan ide atau karya yang kreatif untuk menyelesaikan masalah atau menciptakan nilai.',
            ],
            [
                'dimensi' => 'Kemampuan Beradaptasi',
                'elemen' => 'Menyesuaikan diri dengan perubahan dan situasi yang baru',
                'sub_elemen' => 'Peserta didik mampu beradaptasi dengan perubahan dan menghadapi tantangan dengan cara yang kreatif dan fleksibel.',
                'capaian_akhir_fase' => '',
            ],
        ];

        foreach ($data as $target) {
            DB::table('tb_target_capaian')->insert($target);
        }
    }
}
