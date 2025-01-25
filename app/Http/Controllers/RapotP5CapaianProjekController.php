<?php

namespace App\Http\Controllers;

use App\Models\DataProjekTargetCapaian;
use App\Models\KelolaKelas;
use App\Models\KelompokProjek;
use App\Models\KelompokProjekDataProjek;
use App\Models\RapotP5CapaianProjek;
use App\Models\Siswa;
use App\Models\TargetCapaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RapotP5CapaianProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Input Nilai Projek';
        $kelompokProjek = KelompokProjek::orderBy('nama')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_kelas', session('id_kelas'))
            ->where('id_user', auth()->user()->id)
            ->get();
    
        if ($request->has('id_kelompok_projek')) {
            $kelompokProjekDataProjek = KelompokProjekDataProjek::with('dataProjek')->where('id_kelompok_projek', $request->id_kelompok_projek)->get();
            
            if ($request->has('id_kelompok_projek_data_projek')) {
                $id_data_projek = KelompokProjekDataProjek::where('id_kelompok_projek_data_projek', $request->id_kelompok_projek_data_projek)->first()->id_data_projek;
                $dataProjekTargetCapaian = DataProjekTargetCapaian::with('targetCapaian')->where('id_data_projek', $id_data_projek)->get();

                if ($request->has('id_target_capaian')) {
                    $targetCapaian = TargetCapaian::find($request->id_target_capaian);

                    $kelola_kelas = KelolaKelas::where('id_guru', auth()->user()->id)
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


                    return view('rapot_p5.nilai_capaian.create_edit_nilai_capaian', compact(
                        'kelompokProjek',
                        'kelompokProjekDataProjek',
                        'dataProjekTargetCapaian',
                        'targetCapaian',
                        'kelola_kelas',
                        'title',
                    ));
                }

                return view('rapot_p5.nilai_capaian.pilih_dimensi', compact(
                    'kelompokProjek',
                    'kelompokProjekDataProjek',
                    'dataProjekTargetCapaian',
                    'title'
                ));
            }
    
            return view('rapot_p5.nilai_capaian.pilih_projek', compact(
                'kelompokProjek',
                'kelompokProjekDataProjek',
                'title'
            ));
        }
    
        $title = 'Input Nilai Projek';
        return view('rapot_p5.nilai_capaian.pilih_kelompok_projek', compact('title', 'kelompokProjek'));
    } 
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RapotP5CapaianProjek $rapotP5CapaianProjek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RapotP5CapaianProjek $rapotP5CapaianProjek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RapotP5CapaianProjek $rapotP5CapaianProjek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RapotP5CapaianProjek $rapotP5CapaianProjek)
    {
        //
    }
}
