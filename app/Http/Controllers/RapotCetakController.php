<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use App\Models\TujuanPembelajaran;

class RapotCetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
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
        
        return view('rapot.cetak.index', compact('siswa', 'title', 'rapot', 'profilSekolah', 'tujuanPembelajaran'));
    }    
}
