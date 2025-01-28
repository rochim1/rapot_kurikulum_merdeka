<?php

namespace App\Http\Controllers;

use App\Models\KelolaKelas;
use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotTtdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $kelola_kelas = KelolaKelas::with('kelas', 'TahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->get();
    
        $ttd_tempat_tanggal_rapot = null;
    
        $kelola_kelas->each(function ($kelola) use (&$ttd_tempat_tanggal_rapot) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)
                                  ->where('status', 'active')
                                  ->get();
            
            $kelola->siswa->each(function ($siswa) use ($kelola, &$ttd_tempat_tanggal_rapot) {
                $rapot = Rapot::where('id_kelas', $kelola->id_kelas)
                              ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                              ->where('id_siswa', $siswa->id_siswa)
                              ->first();
                              
                $siswa->rapot = $rapot;
    
                // Ambil nilai ttd_tempat_tanggal_rapot jika belum ditemukan
                if ($rapot && !$ttd_tempat_tanggal_rapot) {
                    $ttd_tempat_tanggal_rapot = $rapot->ttd_tempat_tanggal_rapot;
                }
            });
        });

        $title = 'Rapot';
        return view('rapot.ttd.index', compact('kelola_kelas', 'title', 'ttd_tempat_tanggal_rapot'));
    }
    

    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'ttd_tempat_tanggal_rapot' => 'required|string',
        ]);

        $kelola_kelas = KelolaKelas::with('kelas','guru','tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->first();

        $profilSekolah = ProfilSekolah::find(1);

        DB::beginTransaction();
        try {
            foreach ($validatedData['id_siswa'] as $siswa_id) {
                Rapot::updateOrCreate(
                    [
                        'id_kelas' => $kelola_kelas->id_kelas,
                        'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                        'id_siswa' => $siswa_id,
                        'id_guru' => $kelola_kelas->id_guru,
                        'nama_kepsek' => $profilSekolah->nama_kepsek,
                        'nip_kepsek' => $profilSekolah->nip_kepsek,
                    ],
                    [
                        'ttd_tempat_tanggal_rapot' => $validatedData['ttd_tempat_tanggal_rapot']
                    ]
                );
            }

            DB::commit();
            Alert::success('Success', 'Data berhasil disimpan!');
            return redirect()->route('rapot_ttd.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.');
            return redirect()->route('rapot_ttd.index');
        }
    }

}
