<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temaData = [
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Pendidikan Karakter',
                'deskripsi_dimensi' => 'Mengajarkan peserta didik untuk memahami pentingnya nilai-nilai moral dan karakter dalam kehidupan sehari-hari, seperti jujur, disiplin, dan tanggung jawab.',
                'nama_tema' => 'Membangun Karakter Positif',
                'deskripsi_tema' => 'Mengajarkan peserta didik untuk memahami nilai-nilai moral dan karakter yang baik dalam kehidupan sehari-hari.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Pengembangan Keterampilan Sosial',
                'deskripsi_dimensi' => 'Meningkatkan kemampuan peserta didik dalam berinteraksi dengan teman sebaya, guru, dan lingkungan sekitar melalui kegiatan yang memperkuat kerjasama dan komunikasi.',
                'nama_tema' => 'Meningkatkan Keterampilan Sosial',
                'deskripsi_tema' => 'Meningkatkan kemampuan peserta didik dalam berkomunikasi dan bekerjasama dengan teman sebaya dan guru.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Literasi Digital',
                'deskripsi_dimensi' => 'Memberikan pemahaman dan keterampilan kepada peserta didik untuk menggunakan teknologi dan media digital secara bijak dan bertanggung jawab.',
                'nama_tema' => 'Penggunaan Teknologi yang Bijak',
                'deskripsi_tema' => 'Mengajarkan peserta didik cara menggunakan teknologi dan media digital secara bertanggung jawab dan bijak.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Kepedulian Sosial',
                'deskripsi_dimensi' => 'Mendorong peserta didik untuk peduli terhadap kondisi sosial dan masyarakat melalui kegiatan sosial, seperti membantu orang lain atau berpartisipasi dalam kegiatan sosial di lingkungan sekolah.',
                'nama_tema' => 'Aksi Sosial untuk Masyarakat',
                'deskripsi_tema' => 'Mengajarkan peserta didik untuk peduli terhadap orang lain dan ikut serta dalam kegiatan sosial di masyarakat.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Penghargaan terhadap Keberagaman',
                'deskripsi_dimensi' => 'Meningkatkan rasa saling menghormati terhadap perbedaan budaya, agama, dan suku melalui kegiatan yang memperkenalkan keberagaman yang ada di sekitar.',
                'nama_tema' => 'Menghormati Keberagaman Budaya',
                'deskripsi_tema' => 'Mengajarkan peserta didik untuk menghormati perbedaan budaya, agama, dan suku yang ada di sekitar mereka.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Kesehatan dan Kebugaran',
                'deskripsi_dimensi' => 'Menanamkan pentingnya gaya hidup sehat dan kebugaran jasmani, serta mempraktikkan pola hidup sehat dalam kehidupan sehari-hari.',
                'nama_tema' => 'Pentingnya Gaya Hidup Sehat',
                'deskripsi_tema' => 'Mengajarkan peserta didik pentingnya menjaga kesehatan fisik dan mental dengan cara yang sehat dan aktif.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Pengelolaan Lingkungan',
                'deskripsi_dimensi' => 'Mengajarkan peserta didik tentang pentingnya menjaga dan merawat lingkungan, serta langkah-langkah yang dapat diambil untuk mengurangi dampak negatif terhadap lingkungan sekitar.',
                'nama_tema' => 'Pelestarian Lingkungan Alam',
                'deskripsi_tema' => 'Meningkatkan kesadaran peserta didik untuk menjaga lingkungan dan mengurangi dampak negatif terhadap alam.',
            ],
            [
                'id_tahun_ajaran' => 1,
                'dimensi' => 'Inovasi dan Kreativitas',
                'deskripsi_dimensi' => 'Mendorong peserta didik untuk berpikir kreatif dan inovatif, serta mengembangkan ide-ide baru yang dapat bermanfaat dalam kehidupan sehari-hari dan di masa depan.',
                'nama_tema' => 'Mengembangkan Kreativitas dan Inovasi',
                'deskripsi_tema' => 'Mengajarkan peserta didik untuk berkreasi dan berinovasi dalam berbagai bidang kehidupan.',
            ],
        ];

        foreach ($temaData as $data) {
            Tema::create($data);
        }
    }
}
