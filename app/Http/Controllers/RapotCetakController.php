<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\RapotP5CapaianProjek;
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

        $title = 'Rapot';

        return view('rapot_cetak.index', compact('title', 'rapot'));
    }

    public function show($id, Request $request)
    {
        $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru.user', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->whereHas('siswa', function ($query) use ($id) {
                $query->where('id_siswa', $id);
            })
            ->get();

        if (!$rapot) {
            return redirect()->back()->with('error', 'Data rapot tidak ditemukan.');
        }

        if ($rapot) {
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

        $profilSekolah = ProfilSekolah::find(1);
        $nama_siswa = $rapot->first()->siswa->nama;
        
        $pdf = Pdf::loadView('rapot_cetak.cetak.view_persiswa', compact('rapot', 'profilSekolah', 'nama_siswa'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        if ($request->get('btn') == 'view') {
            return $pdf->stream('rapot kelas 1a.pdf');
        } else if ($request->get('btn') == 'download') {
            return $pdf->download('Rapot ' . $nama_siswa . '.pdf');
        }
    }

    public function rapot_all(Request $request)
    {
        if ($request->download_all == 'rapot_umum') {
            $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru.user', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->where('id_guru', session('id_guru'))
                ->get();

            if (!$rapot) {
                return redirect()->back()->with('error', 'Data rapot tidak ditemukan.');
            }

            if ($rapot) {
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
            $profilSekolah = ProfilSekolah::find(1);
            $nama_siswa = 'Kelas ' . $rapot->first()->kelas->kelas_tingkatan . '.' . $rapot->first()->kelas->kelas_abjad;

            $pdf = Pdf::loadView('rapot_cetak.cetak.view_persiswa', compact('rapot', 'profilSekolah', 'nama_siswa'))
                ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
            return $pdf->stream('rapot kelas 1a.pdf');
        } else if ($request->download_all == 'rapot_p5') {
            $rapot = Rapot::with(['kelas', 'TahunAjaran', 'siswa', 'guru.user', 'RapotP5CapaianProjek.KelompokProjekDataProjek.dataProjek', 'RapotP5CatatanProsesProjek'])
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->where('id_guru', session('id_guru'))
                ->paginate(1);

            $profilSekolah = ProfilSekolah::find(1);
            $nama_siswa = 'P5';
            $pdf = Pdf::loadView('rapot_cetak.cetak_p5.view_persiswa', compact('rapot', 'profilSekolah', 'nama_siswa'))
                ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


            return $rapot;
            return $pdf->stream('rapot kelas 1a.pdf');
        }
    }
}
