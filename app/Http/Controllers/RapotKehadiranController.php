<?php

namespace App\Http\Controllers;

use App\Models\KelolaKelas;
use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotKehadiranController extends Controller
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
        return view('rapot.kehadiran.index', compact('kelola_kelas', 'title'));
    }
 
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'sakit' => 'required|array',
            'izin' => 'required|array',
            'tanpa_keterangan' => 'required|array',
        ]);

        $kelola_kelas = KelolaKelas::with('kelas','guru','tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->first();

        $profilSekolah = ProfilSekolah::find(1);

        foreach ($validatedData['id_siswa'] as $siswa_id) {
            Rapot::updateOrCreate(
                [
                    'id_kelas' => $kelola_kelas->id_kelas,
                    'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                    'id_siswa' => $siswa_id,
                    'id_guru' => $kelola_kelas->id_guru,
                ],
                [
                    'nama_kepsek' => $profilSekolah->nama_kepsek,
                    'nip_kepsek' => $profilSekolah->nip_kepsek,
                    'sakit' => $validatedData['sakit'][$siswa_id] ?? null,
                    'izin' => $validatedData['izin'][$siswa_id] ?? null,
                    'tanpa_keterangan' => $validatedData['tanpa_keterangan'][$siswa_id] ?? null,
                ]
            );
        }        

        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('rapot_kehadiran.index');
    }
}