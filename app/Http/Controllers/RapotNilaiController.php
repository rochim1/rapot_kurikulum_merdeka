<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelolaKelas;
use App\Models\MataPelajaran;
use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use App\Models\TujuanPembelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelola_kelas = KelolaKelas::with('kelas')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->get();
    
        $kelola_kelas->each(function ($kelola) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->where('status', 'active')->get();
        });
    
        // Mendapatkan mata pelajaran berdasarkan kelas
        $mataPelajaran = $kelola_kelas->map(function($kelola) {
            return MataPelajaran::where('kelompok', $kelola->kelas->fase)
                ->orderBy('nama_mata_pelajaran', 'asc')
                ->get();
        })->flatten();
    
        // Mendapatkan tujuan pembelajaran berdasarkan id_mata_pelajaran yang dipilih
        $tujuan_pembelajaran = collect();
        $mataPelajaranSelected = null;
        $id_mata_pelajaran = null;
    
        if ($request->has('id_mata_pelajaran')) {
            $tujuan_pembelajaran = TujuanPembelajaran::where('id_mata_pelajaran', $request->id_mata_pelajaran)
                ->where('is_active', true)
                ->get();

            

            if($tujuan_pembelajaran->isEmpty()) {
                Alert::error('Kerja Buruk', 'Data Belum di inputkan pada Tujuan Pembelajaran!');
            } else {
                $id_mata_pelajaran = $tujuan_pembelajaran->first()->id_mata_pelajaran;
            }
        } 

        $title = 'rapot';
        return view('rapot.nilai', compact('kelola_kelas', 'mataPelajaran', 'tujuan_pembelajaran', 'id_mata_pelajaran', 'mataPelajaranSelected', 'title'));  
    }
    

    public function storeOrUpdate(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'id_mata_pelajaran' => 'required|array',
            'nilai_akhir' => 'nullable|array',
            'tujuan_tercapai' => 'nullable|array',
            'tujuan_tidak_tercapai' => 'nullable|array',
            'nilai_akhir.*' => 'nullable|numeric', // Validasi nilai akhir
            'tujuan_tercapai.*' => 'nullable|array', // Validasi tujuan tercapai
            'tujuan_tidak_tercapai.*' => 'nullable|array', // Validasi tujuan tidak tercapai
        ]);
    
        // Ambil data kelola_kelas dan profilSekolah sesuai kebutuhan
        $kelola_kelas = KelolaKelas::with('kelas', 'guru', 'tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->first();
    
        $profilSekolah = ProfilSekolah::find(1);
    
        // Loop melalui setiap siswa yang ada pada form
        foreach ($validatedData['id_siswa'] as $siswa_id) {
            // Menyimpan atau memperbarui data rapor
            $rapot = Rapot::updateOrCreate(
                [
                    'id_kelas' => $kelola_kelas->id_kelas,
                    'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                    'id_siswa' => $siswa_id,
                    'ket_naik_kelas' => $kelola_kelas->tahunAjaran->semester == 'Ganjil' ? false : true,
                    'nama_wali_kelas' => $kelola_kelas->guru->nama,
                    'nip_wali_kelas' => $kelola_kelas->guru->nip,
                    'nama_kepsek' => $profilSekolah->nama_kepsek,
                    'nip_kepsek' => $profilSekolah->nip_kepsek,
                    'ttd_tempat_tanggal_rapot' => $profilSekolah->ttd_tempat_tanggal_rapot,
                ]
            );
    
            // Loop untuk menyimpan nilai dan tujuan pembelajaran
            DB::table('tb_rapot_nilai')->updateOrInsert(
                [
                    'id_rapot' => $rapot->id_rapot,
                    'id_mata_pelajaran' => $validatedData['id_mata_pelajaran'][$siswa_id] ?? null,
                    'nilai_akhir' => $validatedData['nilai_akhir'][$siswa_id] ?? null,
                ],
                [
                    'tujuan_pembelajaran_tercapai' => isset($validatedData['tujuan_tercapai'][$siswa_id])
                        ? json_encode($validatedData['tujuan_tercapai'][$siswa_id]) 
                        : null,
                    'tujuan_pembelajaran_tidak_tercapai' => isset($validatedData['tujuan_tidak_tercapai'][$siswa_id]) 
                        ? json_encode($validatedData['tujuan_tidak_tercapai'][$siswa_id]) 
                        : null,
                ]
            );
        }
    
        // Memberikan feedback sukses
        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('rapot_nilai.index');
    }   

}
