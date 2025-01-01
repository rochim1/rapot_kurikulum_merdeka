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

    $ekstrakulikuler = Ekstrakulikuler::all(); // Fetch all extracurricular activities

    // Iterate through each 'kelola_kelas' to fetch 'siswa' and their 'rapot'
    $kelola_kelas->each(function ($kelola) {
        $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)
            ->where('status', 'active')
            ->get();

        // Fetch 'rapot' and related 'ekstrakulikuler' for each 'siswa'
        $kelola->siswa->each(function ($siswa) use ($kelola) {
            $siswa->rapot = Rapot::where('id_kelas', $kelola->id_kelas)
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->where('id_siswa', $siswa->id_siswa)
                ->first();

            // Retrieve related extracurricular activities through pivot table
            if ($siswa->rapot) {
                $siswa->ekstrakulikuler = $siswa->rapot->ekstrakulikuler;
            }
        });
    });

    $title = 'Rapot';
    return view('rapot.ekstrakulikuler', compact('kelola_kelas', 'title', 'ekstrakulikuler')); // Pass 'ekstrakulikuler' to the view
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
                    'nama_wali_kelas' => $kelola_kelas->guru->nama,
                    'nip_wali_kelas' => $kelola_kelas->guru->nip,
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