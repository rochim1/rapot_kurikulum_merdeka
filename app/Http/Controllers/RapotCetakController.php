<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use App\Models\TujuanPembelajaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RapotCetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->get();

        $tujuanPembelajaran = TujuanPembelajaran::all(); // Ambil semua tujuan pembelajaran
        $profilSekolah = ProfilSekolah::find(1);
        $title = 'Rapot';
        $siswa = Siswa::all();

        // Periksa jika $rapot memiliki data
        if ($rapot->isNotEmpty()) {
            // Iterasi setiap data rapot
            foreach ($rapot as $item) {
                // Periksa jika $item->rapot_nilai bukan null dan memiliki data
                    foreach ($item->rapotNilai as $nilai) {
                        
                        // Decode JSON tujuan_pembelajaran_tercapai
                        $tujuan_ids_tercapai = json_decode($nilai->tujuan_pembelajaran_tercapai);
                        $tujuan_ids_tidak_tercapai = json_decode($nilai->tujuan_pembelajaran_tidak_tercapai);
                        
                        // Cek apakah tujuan_ids terkapai ada dan berupa array
                        if (is_array($tujuan_ids_tercapai)) {
                            // Ambil data tujuan pembelajaran berdasarkan ID yang ada
                            $nilai->tujuan_pembelajaran_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tercapai)->get();
                            // Convert to readable format (text) if needed
                            $nilai->tujuan_pembelajaran_tercapai_text = $nilai->tujuan_pembelajaran_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
                        }

                        // Cek apakah tujuan_ids tidak tercapai ada dan berupa array
                        if (is_array($tujuan_ids_tidak_tercapai)) {
                            // Ambil data tujuan pembelajaran berdasarkan ID yang ada
                            $nilai->tujuan_pembelajaran_tidak_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tidak_tercapai)->get();
                            // Convert to readable format (text) if needed
                            $nilai->tujuan_pembelajaran_tidak_tercapai_text = $nilai->tujuan_pembelajaran_tidak_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
                        }
                    }
            }
        }

        // export pdf
        // $data = [$siswa, $title, $rapot, $profilSekolah, $tujuanPembelajaran];
        if($request->get('export') == 'pdf')
        {
            // $pdf = Pdf::loadView('rapot.cetak.export_pdf', compact('siswa', 'title', 'rapot', 'profilSekolah', 'tujuanPembelajaran'));
            // return $pdf->stream('rapot kelas 1a.pdf');
            $pdf = Pdf::loadView('rapot.cetak.export_pdf', compact('siswa', 'title', 'rapot', 'profilSekolah', 'tujuanPembelajaran'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            return $pdf->stream('rapot kelas 1a.pdf');
        }
        
        return view('rapot.cetak.index', compact('siswa', 'title', 'rapot', 'profilSekolah', 'tujuanPembelajaran'));
    }

    // public function export_pdf()
    // {
    //     $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
    //         ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
    //         ->where('id_guru', session('id_guru'))
    //         ->get();

    //     $tujuanPembelajaran = TujuanPembelajaran::all(); // Ambil semua tujuan pembelajaran
    //     $profilSekolah = ProfilSekolah::find(1);
    //     $title = 'Rapot';
    //     $siswa = Siswa::all();

    //     // Periksa jika $rapot memiliki data
    //     if ($rapot->isNotEmpty()) {
    //         // Iterasi setiap data rapot
    //         foreach ($rapot as $item) {
    //             // Periksa jika $item->rapot_nilai bukan null dan memiliki data
    //                 foreach ($item->rapotNilai as $nilai) {
                        
    //                     // Decode JSON tujuan_pembelajaran_tercapai
    //                     $tujuan_ids_tercapai = json_decode($nilai->tujuan_pembelajaran_tercapai);
    //                     $tujuan_ids_tidak_tercapai = json_decode($nilai->tujuan_pembelajaran_tidak_tercapai);
                        
    //                     // Cek apakah tujuan_ids terkapai ada dan berupa array
    //                     if (is_array($tujuan_ids_tercapai)) {
    //                         // Ambil data tujuan pembelajaran berdasarkan ID yang ada
    //                         $nilai->tujuan_pembelajaran_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tercapai)->get();
    //                         // Convert to readable format (text) if needed
    //                         $nilai->tujuan_pembelajaran_tercapai_text = $nilai->tujuan_pembelajaran_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
    //                     }

    //                     // Cek apakah tujuan_ids tidak tercapai ada dan berupa array
    //                     if (is_array($tujuan_ids_tidak_tercapai)) {
    //                         // Ambil data tujuan pembelajaran berdasarkan ID yang ada
    //                         $nilai->tujuan_pembelajaran_tidak_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tidak_tercapai)->get();
    //                         // Convert to readable format (text) if needed
    //                         $nilai->tujuan_pembelajaran_tidak_tercapai_text = $nilai->tujuan_pembelajaran_tidak_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
    //                     }
    //                 }
    //         }
    //     }

    //     $data = [$siswa, $title, $rapot, $profilSekolah, $tujuanPembelajaran];
    //     $pdf = Pdf::loadView('pdf.invoice', $data);
    //     return $pdf->download('rapot kelas 1a.pdf');
    // }
}
