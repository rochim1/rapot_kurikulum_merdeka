<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelolaKelas;
use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\RapotCatatanWaliKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotCatatanWaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $kelola_kelas = KelolaKelas::with('kelas', 'TahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->get();

        $kelola_kelas->each(function ($kelola) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->where('status', 'active')->get();
        
            $kelola->siswa->each(function ($siswa) use ($kelola) {
                $siswa->rapot = DB::table('tb_rapot')
                    ->where('id_kelas', $kelola->id_kelas)
                    ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                    ->where('id_siswa', $siswa->id_siswa)
                    ->first();
            });
        });

        $title = 'Rapot';
        return view('rapot.catatan_wali_kelas', compact('kelola_kelas', 'title'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'catatan' => 'required|array',
            'catatan.*' => 'nullable|string',
        ]);

        $kelola_kelas = KelolaKelas::with('kelas','guru','tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->first();

        $profilSekolah = ProfilSekolah::find(1);

        foreach ($validatedData['id_siswa'] as $siswa_id) {
            Rapot::updateOrCreate(
                [
                    'id_kelas' => $kelola_kelas->id_kelas,
                    'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                    'id_siswa' => $siswa_id,
                    'ket_naik_kelas' => $kelola_kelas->tahunAjaran->semester == 'Ganjil' ? false : true,
                    'id_guru' => $kelola_kelas->pluck('id_guru')->first(),
                    'nama_kepsek' => $profilSekolah->nama_kepsek,
                    'nip_kepsek' => $profilSekolah->nip_kepsek,
                    'ttd_tempat_tanggal_rapot' => $profilSekolah->ttd_tempat_tanggal_rapot,
                ],
                [
                    'catatan_wali_kelas' => $validatedData['catatan'][$siswa_id] ?? null,
                ]
            );
        }        

        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('rapot_catatan_wali_kelas.index');
    }
}
