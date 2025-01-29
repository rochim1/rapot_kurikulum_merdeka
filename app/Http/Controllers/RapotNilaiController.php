<?php

namespace App\Http\Controllers;

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
            ->where('id_guru', session('id_guru'))
            ->get();

        $kelola_kelas->each(function ($kelola) {
            $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->where('status', 'active')->get();
        });

        $mataPelajaran = MataPelajaran::orderBy('kelompok', 'ASC')
        ->orderBy('nama_mata_pelajaran', 'ASC')
        ->get();

        $tujuan_pembelajaran = collect();
        $mataPelajaranSelected = null;
        $id_mata_pelajaran = null;
        $title = 'rapot';

        if ($request->has('id_mata_pelajaran')) {
            $rapot_nilai = Rapot::with(['siswa', 'rapotNilai' => function ($query) use ($request) {
                $query->where('id_mata_pelajaran', $request->id_mata_pelajaran);
            }])
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->get();

            $tujuan_pembelajaran = TujuanPembelajaran::where('id_mata_pelajaran', $request->id_mata_pelajaran)
                ->where('is_active', true)
                ->get();

            if ($tujuan_pembelajaran->isEmpty()) {
                Alert::error('Data Tidak Ditemukan', 'Tujuan Pembelajaran belum diinput!');
            } else {
                $id_mata_pelajaran = $tujuan_pembelajaran->first()->id_mata_pelajaran;
            }

            if ($rapot_nilai->count() > 0) {
                $title = 'Edit Rapot';
                return view('rapot.nilai.nilai_edit', compact(
                    'rapot_nilai',
                    'kelola_kelas',
                    'mataPelajaran',
                    'tujuan_pembelajaran',
                    'id_mata_pelajaran',
                    'mataPelajaranSelected',
                    'title'
                ));
            }
        }

        return view('rapot.nilai.index', compact(
            'kelola_kelas',
            'mataPelajaran',
            'tujuan_pembelajaran',
            'id_mata_pelajaran',
            'mataPelajaranSelected',
            'title'
        ));
    }

    /**
     * Store or update the resource.
     */
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'id_mata_pelajaran' => 'required|array',
            'nilai_akhir' => 'nullable|array',
            'tujuan_tercapai' => 'nullable|array',
            'tujuan_tidak_tercapai' => 'nullable|array',
            'nilai_akhir.*' => 'nullable|numeric',
            'tujuan_tercapai.*' => 'nullable|array',
            'tujuan_tidak_tercapai.*' => 'nullable|array',
        ]);

        $kelola_kelas = KelolaKelas::with('kelas', 'guru', 'tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->first();

        $profilSekolah = ProfilSekolah::find(1);

        foreach ($validatedData['id_siswa'] as $siswa_id) {
            $rapot = Rapot::updateOrCreate(
                [
                    'id_kelas' => $kelola_kelas->id_kelas,
                    'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                    'id_siswa' => $siswa_id,
                ],
                [
                    'naik_kelas' => $kelola_kelas->tahunAjaran->semester == 'Ganjil' ? false : true,
                    'id_guru' => $kelola_kelas->id_guru,
                    'nama_kepsek' => $profilSekolah->nama_kepsek,
                    'nip_kepsek' => $profilSekolah->nip_kepsek,
                ]
            );

            DB::table('tb_rapot_nilai')->updateOrInsert(
                [
                    'id_rapot' => $rapot->id_rapot,
                    'id_mata_pelajaran' => $validatedData['id_mata_pelajaran'][$siswa_id] ?? null,
                ],
                [
                    'tujuan_pembelajaran_tercapai' => isset($validatedData['tujuan_tercapai'][$siswa_id])
                        ? json_encode($validatedData['tujuan_tercapai'][$siswa_id])
                        : null,
                    'tujuan_pembelajaran_tidak_tercapai' => isset($validatedData['tujuan_tidak_tercapai'][$siswa_id])
                        ? json_encode($validatedData['tujuan_tidak_tercapai'][$siswa_id])
                        : null,
                    'nilai_akhir' => $validatedData['nilai_akhir'][$siswa_id] ?? null,
                ]
            );
        }

        Alert::success('Berhasil', 'Data berhasil disimpan!');
        return redirect()->route('rapot_nilai.index');
    }
}
