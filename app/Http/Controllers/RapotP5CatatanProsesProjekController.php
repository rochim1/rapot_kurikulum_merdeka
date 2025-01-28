<?php

namespace App\Http\Controllers;

use App\Models\KelolaKelas;
use App\Models\KelompokProjek;
use App\Models\KelompokProjekDataProjek;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotP5CatatanProsesProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelompokProjek = KelompokProjek::orderBy('nama')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_kelas', session('id_kelas'))
            ->where('id_user', auth()->user()->id)
            ->get();
    
        if ($request->has('id_kelompok_projek')) {
            $kelompokProjekDataProjek = KelompokProjekDataProjek::with('dataProjek')
                                                                ->where('id_kelompok_projek', $request->id_kelompok_projek)
                                                                ->get();
            
            if ($request->has('id_kelompok_projek_data_projek')) {
    
                $kelola_kelas = KelolaKelas::where('id_guru', session('id_guru'))
                                            ->where('id_kelas', session('id_kelas'))
                                            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                                            ->get();
    
                $kelola_kelas->each(function ($kelola) {
                    $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)
                                        ->where('status', 'active')
                                        ->get();
                
                    $kelola->siswa->each(function ($siswa) use ($kelola) {
                        $siswa->rapot = DB::table('tb_rapot')
                            ->where('id_kelas', $kelola->id_kelas)
                            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                            ->where('id_siswa', $siswa->id_siswa)
                            ->first();
                    });
                });
    
                // Cek apakah ada siswa yang belum memiliki rapot
                $siswaTanpaRapot = $kelola_kelas->flatMap(function ($kelola) {
                    return $kelola->siswa->filter(function ($siswa) {
                        return is_null($siswa->rapot); // Filter siswa yang belum punya rapot
                    });
                });
    
                if ($siswaTanpaRapot->isNotEmpty()) {
                    Alert::error('Error Rapot P5', 'Beberapa siswa belum memiliki rapot. Silakan input Rapot Utama terlebih dahulu.');
                    return redirect()->route('rapot_p5_catatan_proses_projek.index');
                }
    
                // Ambil catatan yang ada di tabel tb_rapot_p5_catatan_proses_projek
                $catatanProsesProjek = DB::table('tb_rapot_p5_catatan_proses_projek')
                    ->where('id_kel_pro_data_pro', $request->id_kelompok_projek_data_projek)
                    ->get()
                    ->keyBy('id_rapot'); // Menggunakan id_rapot sebagai key
    
                $title = 'Rapot Catatan Proses Projek';
                $id_kelompok_projek_data_projek = $request->id_kelompok_projek_data_projek;
    
                return view('rapot_p5.catatan_proses_projek.create_edit_catatan_proses', compact(
                    'kelompokProjek',
                    'kelompokProjekDataProjek',
                    'kelola_kelas',
                    'catatanProsesProjek', // Kirim data catatan ke view
                    'id_kelompok_projek_data_projek',
                    'title'
                ));
            }
    
            $title = 'Rapot Catatan Proses Projek';
            return view('rapot_p5.catatan_proses_projek.pilih_projek', compact(
                'kelompokProjek',
                'kelompokProjekDataProjek',
                'title'
            ));
        }
    
        $title = 'Rapot Catatan Proses Projek';
        return view('rapot_p5.catatan_proses_projek.pilih_kelompok_projek', compact('title', 'kelompokProjek'));
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'id_rapot' => 'required|array',
            'id_kel_pro_data_pro' => 'required|array',
            'catatan' => 'required|array',
            'catatan.*' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
    
        try {
            foreach ($validated['id_rapot'] as $key => $id_rapot) {
                DB::table('tb_rapot_p5_catatan_proses_projek')->updateOrInsert(
                    [
                        'id_rapot' => $id_rapot,
                        'id_kel_pro_data_pro' => $validated['id_kel_pro_data_pro'][$key],
                    ],
            [
                        'catatan_proses_projek' => $validated['catatan'][$id_rapot] ?? null,
                        'updated_at' => now(),
                    ]
                );
            }
    
            DB::commit();
            Alert::success('Success', 'Data berhasil disimpan!');
            return redirect()->route('rapot_p5_catatan_proses_projek.index');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Terjadi kesalahan, data gagal disimpan.');
            return back();
        }
    }
}
