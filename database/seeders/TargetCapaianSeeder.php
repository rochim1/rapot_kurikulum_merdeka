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
                'elemen' => 'AKHLAK BERAGAMA',
                'sub_elemen' => 'Mencintai Tuhan Yang Maha Esa',
                'capaian_akhir_fase' => 'Mengenal sifat-sifat utama Tuhan Yang Maha Esa bahwa Dia adalah Sang Pencipta yang Maha Pengasih dan Maha Penyayang dan mengenali kebaikan dirinya sebagai cerminan sifat Tuhan.',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK BERAGAMA',
                'sub_elemen' => 'Pemahaman Agama/Kepercayaan',
                'capaian_akhir_fase' => 'Mengenal unsur-unsur utama agama/kepercayaan (ajaran, ritual keagamaan, kitab suci, dan orang suci/utusan Tuhan YME).',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK BERAGAMA',
                'sub_elemen' => 'Pelaksanaan Ritual Ibadah',
                'capaian_akhir_fase' => 'Terbiasa melaksanakan ibadah sesuai ajaran agama/ kepercayaannya.',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK PRIBADI',
                'sub_elemen' => 'Integritas',
                'capaian_akhir_fase' => 'Membiasakan bersikap jujur terhadap diri sendiri dan orang lain dan berani menyampaikan kebenaran atau fakta.',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK PRIBADI',
                'sub_elemen' => 'Merawat Diri secara Fisik, Mental, dan Spiritual',
                'capaian_akhir_fase' => 'Memiliki rutinitas sederhana yang diatur secara mandiri dan dijalankan sehari-hari serta menjaga kesehatan dan keselamatan/keamanan diri dalam semua aktivitas kesehariannya.',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK KEPADA MANUSIA',
                'sub_elemen' => 'Menghargai Perbedaan',
                'capaian_akhir_fase' => 'Menghargai keberagaman yang ada dalam keluarga dan masyarakat sekitar.',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK KEPADA MANUSIA',
                'sub_elemen' => 'Berempati dan Menyayangi Sesama',
                'capaian_akhir_fase' => 'Menunjukkan kepedulian kepada orang lain dan berbagi dengan orang lain di lingkungannya.',
            ],
            [
                'dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia',
                'elemen' => 'AKHLAK KEPADA ALAM',
                'sub_elemen' => 'Menjaga Lingkungan',
                'capaian_akhir_fase' => 'Menunjukkan kebiasaan baik dalam menjaga lingkungan dan tidak merusak alam.',
            ],

            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'MENGENAL DAN MENGHARGAI BUDAYA',
                'sub_elemen' => 'Mendalami budaya dan identitas budaya',
                'capaian_akhir_fase' => 'Mengidentifikasi dan mendeskripsikan ide-ide tentang dirinya dan beberapa kelompok di lingkungan sekitarnya.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'MENGENAL DAN MENGHARGAI BUDAYA',
                'sub_elemen' => 'Mengeksplorasi dan membandingkan pengetahuan budaya, kepercayaan, serta praktiknya',
                'capaian_akhir_fase' => 'Mengidentifikasi dan mendeskripsikan praktik keseharian diri dan budayanya.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'MENGENAL DAN MENGHARGAI BUDAYA',
                'sub_elemen' => 'Menumbuhkan rasa menghormati terhadap keanekaragaman budaya',
                'capaian_akhir_fase' => 'Mendeskripsikan pengalaman dan pemahaman hidup bersama-sama dalam kemajemukan.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'KOMUNIKASI DAN INTERAKSI ANTAR BUDAYA',
                'sub_elemen' => 'Berkomunikasi antar budaya',
                'capaian_akhir_fase' => 'Mengenali bahwa diri dan orang lain menggunakan kata, gambar, dan bahasa tubuh yang dapat memiliki makna yang berbeda di lingkungan sekitarnya.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'KOMUNIKASI DAN INTERAKSI ANTAR BUDAYA',
                'sub_elemen' => 'Mempertimbangkan dan menumbuhkan berbagai perspektif',
                'capaian_akhir_fase' => 'Mengekspresikan pandangannya terhadap topik yang umum dan mendengarkan sudut pandang orang lain yang berbeda dari dirinya dalam lingkungan keluarga dan sekolah.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'REFLEKSI DAN BERTANGGUNG JAWAB TERHADAP PENGALAMAN KEBINEKAAN',
                'sub_elemen' => 'Refleksi terhadap pengalaman kebinekaan.',
                'capaian_akhir_fase' => 'Menyebutkan apa yang telah dipelajari tentang orang lain dari interaksinya dengan kemajemukan budaya di lingkungan sekolah dan rumah.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'REFLEKSI DAN BERTANGGUNG JAWAB TERHADAP PENGALAMAN KEBINEKAAN',
                'sub_elemen' => 'Menghilangkan stereotip dan prasangka',
                'capaian_akhir_fase' => 'Mengenali perbedaan tiap orang atau kelompok dan menyikapinya sebagai kewajaran.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'REFLEKSI DAN BERTANGGUNG JAWAB TERHADAP PENGALAMAN KEBINEKAAN',
                'sub_elemen' => 'Menyelaraskan perbedaan budaya',
                'capaian_akhir_fase' => 'Mengidentifikasi perbedaan budaya yang konkret di lingkungan sekitar.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'BERKEADILAN SOSIAL',
                'sub_elemen' => 'Aktif membangun masyarakat yang inklusif, adil, dan berkelanjutan',
                'capaian_akhir_fase' => 'Menjalin pertemanan tanpa memandang perbedaan agama, suku, ras, jenis kelamin, dan perbedaan lainnya, dan mengenal masalah-masalah sosial, ekonomi, dan lingkungan di lingkungan sekitarnya.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'BERKEADILAN SOSIAL',
                'sub_elemen' => 'Berpartisipasi dalam proses pengambilan keputusan bersama',
                'capaian_akhir_fase' => 'Mengidentifikasi pilihan-pilihan berdasarkan kebutuhan dirinya dan orang lain ketika membuat keputusan.',
            ],
            [
                'dimensi' => 'Nerkebinekaan Global',
                'elemen' => 'BERKEADILAN SOSIAL',
                'sub_elemen' => 'Memahami peran individu dalam demokrasi',
                'capaian_akhir_fase' => 'Mengidentifikasi peran, hak dan kewajiban warga dalam masyarakat demokratis.',
            ],

            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'KOLABORASI',
                'sub_elemen' => 'Kerja sama',
                'capaian_akhir_fase' => 'Menerima dan melaksanakan tugas serta peran yang diberikan kelompok dalam sebuah kegiatan bersama.',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'KOLABORASI',
                'sub_elemen' => 'Komunikasi untuk mencapai tujuan bersama',
                'capaian_akhir_fase' => 'Memahami informasi sederhana dari orang lain dan menyampaikan informasi sederhana kepada orang lain menggunakan kata-katanya sendiri.',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'KOLABORASI',
                'sub_elemen' => 'Saling ketergantungan positif',
                'capaian_akhir_fase' => 'Mengenali kebutuhan-kebutuhan diri sendiri yang memerlukan orang lain dalam pemenuhannya.',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'KOLABORASI',
                'sub_elemen' => 'Koordinasi Sosial',
                'capaian_akhir_fase' => 'Melaksanakan aktivitas kelompok sesuai dengan kesepakatan bersama dengan bimbingan, dan saling mengingatkan adanya kesepakatan tersebut.',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'KEPEDULIAN',
                'sub_elemen' => 'Tanggap terhadap lingkungan Sosial',
                'capaian_akhir_fase' => 'Peka dan mengapresiasi orang-orang di lingkungan sekitar, kemudian melakukan tindakan sederhana untuk mengungkapkannya.',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'KEPEDULIAN',
                'sub_elemen' => 'Persepsi sosial',
                'capaian_akhir_fase' => 'Mengenali berbagai reaksi orang lain di lingkungan sekitar dan penyebabnya.',
            ],
            [
                'dimensi' => 'Bergotong Royong',
                'elemen' => 'BERBAGI',
                'sub_elemen' => 'Berbagi',
                'capaian_akhir_fase' => 'Memberi dan menerima hal yang dianggap berharga dan penting kepada/dari orang-orang di lingkungan sekitar.',
            ],

            [
                'dimensi' => 'Mandiri',
                'elemen' => 'PEMAHAMAN DIRI DAN SITUASI YANG DIHADAPI',
                'sub_elemen' => 'Mengenali kualitas dan minat diri serta tantangan yang dihadapi',
                'capaian_akhir_fase' => 'Mengidentifikasi dan menggambarkan kemampuan, prestasi, dan ketertarikannya secara subjektif.',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'PEMAHAMAN DIRI DAN SITUASI YANG DIHADAPI',
                'sub_elemen' => 'Mengembangkan refleksi diri',
                'capaian_akhir_fase' => 'Melakukan refleksi untuk mengidentifikasi kekuatan dan kelemahan, serta prestasi dirinya.',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'REGULASI DIRI',
                'sub_elemen' => 'Regulasi emosi',
                'capaian_akhir_fase' => 'Mengidentifikasi perbedaan emosi yang dirasakannya dan situasi-situasi yang menyebabkannya serta mengekspresikan secara wajar.',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'REGULASI DIRI',
                'sub_elemen' => 'Penetapan tujuan belajar, prestasi, dan pengembangan diri serta rencana strategis untuk mencapainya',
                'capaian_akhir_fase' => 'Menetapkan target belajar dan merencanakan waktu dan tindakan belajar yang akan dilakukannya.',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'REGULASI DIRI',
                'sub_elemen' => 'Menunjukkan inisiatif dan bekerja secara mandiri',
                'capaian_akhir_fase' => 'Berinisiatif untuk mengerjakan tugas-tugas rutin secara mandiri dibawah pengawasan dan dukungan orang dewasa.',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'REGULASI DIRI',
                'sub_elemen' => 'Mengembangkan pengendalian dan disiplin diri',
                'capaian_akhir_fase' => 'Melaksanakan kegiatan belajar di kelas dan menyelesaikan tugas-tugas dalam waktu yang telah disepakati.',
            ],
            [
                'dimensi' => 'Mandiri',
                'elemen' => 'REGULASI DIRI',
                'sub_elemen' => 'Percaya diri, tangguh (resilient), dan adaptif',
                'capaian_akhir_fase' => 'Berani mencoba dan adaptif menghadapi situasi baru serta bertahan mengerjakan tugas-tugas yang disepakati hingga tuntas.',
            ],

            [
                'dimensi' => 'Bernalar Kritis',
                'elemen' => 'MEMPEROLEH DAN MEMPROSES INFORMASI DAN GAGASAN',
                'sub_elemen' => 'Mengajukan pertanyaan',
                'capaian_akhir_fase' => 'Mengajukan pertanyaan untuk menjawab keingin tahuannya dan untuk mengidentifikasi suatu permasalahan mengenai dirinya dan lingkungan sekitarnya.',
            ],
            [
                'dimensi' => 'Bernalar Kritis',
                'elemen' => 'MEMPEROLEH DAN MEMPROSES INFORMASI DAN GAGASAN',
                'sub_elemen' => 'Mengidentifikasi, mengklarifikasi, dan mengolah informasi dan gagasan',
                'capaian_akhir_fase' => 'Mengidentifikasi dan mengolah informasi dan gagasan.',
            ],
            [
                'dimensi' => 'Bernalar Kritis',
                'elemen' => 'MENGANALISIS DAN MENGEVALUASI PENALARAN DAN PROSEDURNYA',
                'sub_elemen' => 'Menganalisis dan mengevaluasi penalaran dan prosedurnya',
                'capaian_akhir_fase' => 'Melakukan penalaran konkret dan memberikan alasan dalam menyelesaikan masalah dan mengambil keputusan.',
            ],
            [
                'dimensi' => 'Bernalar Kritis',
                'elemen' => 'REFLEKSI PEMIKIRAN DAN PROSES BERPIKIR',
                'sub_elemen' => 'Merefleksi dan mengevaluasi pemikirannya sendiri',
                'capaian_akhir_fase' => 'Menyampaikan apa yang sedang dipikirkan secara terperinci.',
            ],
            [
                'dimensi' => 'Kreatif',
                'elemen' => 'MENGHASILKAN GAGASAN YANG ORISINAL',
                'sub_elemen' => 'Menghasilkan gagasan yang orisinal',
                'capaian_akhir_fase' => 'Menggabungkan beberapa gagasan menjadi ide atau gagasan imajinatif yang bermakna untuk mengekspresikan pikiran dan/atau perasaannya.',
            ],
            [
                'dimensi' => 'Kreatif',
                'elemen' => 'MENGHASILKAN KARYA DAN TINDAKAN YANG ORISINAL',
                'sub_elemen' => 'Menghasilkan karya dan tindakan yang orisinal',
                'capaian_akhir_fase' => 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi karya dan tindakan yang dihasilkan.',
            ],
            [
                'dimensi' => 'Kreatif',
                'elemen' => 'MEMILIKI KELUWESAN BERPIKIR DALAM MENCARI ALTERNATIF SOLUSI PERMASALAHAN',
                'sub_elemen' => 'Memiliki keluwesan berpikir dalam mencari alternatif solusi permasalahan',
                'capaian_akhir_fase' => 'Mengidentifikasi gagasan-gagasan kreatif untuk menghadapi situasi dan permasalahan.',
            ],
        ];

        foreach ($data as $target) {
            DB::table('tb_target_capaian')->insert($target);
        }
    }
}
