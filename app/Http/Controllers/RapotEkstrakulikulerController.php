<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Models\Kelas;
use App\Models\KelolaKelas;
use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotEkstrakulikulerController extends Controller
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

        $ekstrakulikuler = Ekstrakulikuler::all();

        $kelola_kelas->each(function ($kelola) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->where('status', 'active')->get();

            $kelola->siswa->each(function ($siswa) use ($kelola) {
                $siswa->rapot = DB::table('tb_rapot')
                    ->where('id_kelas', $kelola->id_kelas)
                    ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                    ->where('id_siswa', $siswa->id_siswa)
                    ->first();

                if ($siswa->rapot) {
                    $siswa->ekstrakulikuler = DB::table('tb_rapot_ekstrakulikuler')
                        ->where('id_rapot', $siswa->rapot->id_rapot)
                        ->get();
                }
            });
        });

        $title = 'Rapot';
        return view('rapot.ekstrakulikuler.index', compact('kelola_kelas', 'title', 'ekstrakulikuler'));
    }
    
    
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'id_ekstrakulikuler' => 'nullable|array',
            'predikat_ekstrakulikuler' => 'nullable|array',
            'catatan_ekstrakulikuler' => 'nullable|array',
            'id_ekstrakulikuler.*' => 'nullable|array', // Nested array validation
            'predikat_ekstrakulikuler.*' => 'nullable|array', // Nested array validation
            'catatan_ekstrakulikuler.*' => 'nullable|array', // Nested array validation
        ]);

        $kelola_kelas = KelolaKelas::with('kelas', 'guru', 'tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
            ->first();

        $profilSekolah = ProfilSekolah::find(1);

        // Loop over each student
        foreach ($validatedData['id_siswa'] as $siswa_id) {
            // Create or update the Rapot record
            $rapot = Rapot::updateOrCreate(
                [
                    'id_kelas' => $kelola_kelas->id_kelas,
                    'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                    'id_siswa' => $siswa_id,
                    'ket_naik_kelas' => $kelola_kelas->tahunAjaran->semester == 'Ganjil' ? false : true,
                    'id_guru' => $kelola_kelas->pluck('id_guru')->first(),
                    'nama_kepsek' => $profilSekolah->nama_kepsek,
                    'nip_kepsek' => $profilSekolah->nip_kepsek,
                    'ttd_tempat_tanggal_rapot' => $profilSekolah->ttd_tempat_tanggal_rapot,
                ]
            );

            // Loop over the extracurriculars for each student
            foreach ($validatedData['id_ekstrakulikuler'][$siswa_id] as $ekskul_id => $ekskul) {
                DB::table('tb_rapot_ekstrakulikuler')->updateOrInsert(
                    [
                        'id_rapot' => $rapot->id_rapot,
                        'id_ekstrakulikuler' => $ekskul_id,
                    ],
                    [
                        'id_ekstrakulikuler' => $ekskul_id,
                        'catatan_ekstrakulikuler' => $validatedData['catatan_ekstrakulikuler'][$siswa_id][$ekskul_id] ?? null,
                        'predikat_ekstrakulikuler' => $validatedData['predikat_ekstrakulikuler'][$siswa_id][$ekskul_id] ?? null,
                    ]
                );
            }
        }

        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('rapot_ekstrakulikuler.index');
    }
}