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

class RapotNaikKelasController extends Controller
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
                $siswa->rapot = Rapot::where('id_kelas', $kelola->id_kelas)
                                     ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                                     ->where('id_siswa', $siswa->id_siswa)
                                     ->first();
            });
        });
        
        $title = 'Rapot';
        return view('rapot.naik_kelas.index', compact('kelola_kelas', 'title'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|array',
            'naik_kelas' => 'required|array',
            'naik_kelas.*' => 'nullable|in:Tinggal Kelas,II,III,IV,V,VI',
        ]);

        $kelola_kelas = KelolaKelas::with('kelas','guru','tahunAjaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', auth()->user()->id)
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
                        'naik_kelas' => $validatedData['naik_kelas'][$siswa_id] ?? null,
                    ]
                );
            }

            DB::commit();
            Alert::success('Success', 'Data berhasil disimpan!');
            return redirect()->route('rapot_naik_kelas.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.');
            return redirect()->route('rapot_naik_kelas.index');
        }
    }

}
