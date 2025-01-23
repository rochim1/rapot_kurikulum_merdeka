<?php

namespace App\Http\Controllers;

use App\Models\KelompokProjekDataProjek;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KelompokProjekDataProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'id_kelompok_projek' => 'required',
            'id_data_projek' => 'required',
        ]);

        $kelompokProjekDataProjek = KelompokProjekDataProjek::where('id_kelompok_projek', $request->id_kelompok_projek)
        ->where('id_data_projek', $request->id_data_projek)
        ->get();
    
    if ($kelompokProjekDataProjek->isNotEmpty()) {
            Alert::error('Error', 'Data Projek sudah ada!');
            return redirect()->back();
        }
    
        KelompokProjekDataProjek::create([
            'id_kelompok_projek' => $request->id_kelompok_projek,
            'id_data_projek' => $request->id_data_projek,
        ]);
    
        Alert::success('Kerja Bagus', 'Data berhasil ditambahkan');
        $kelompokProjekId = $request->id_kelompok_projek;
        return redirect()->route('kelompok_projek.show', $kelompokProjekId);
    }

    /**
     * Display the specified resource.
     */
    public function show(KelompokProjekDataProjek $kelompokProjekDataProjek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelompokProjekDataProjek $kelompokProjekDataProjek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelompokProjekDataProjek $kelompokProjekDataProjek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelompokProjekDataProjek $kelompokProjekDataProjek, Request $request)
    {
        $kelompokProjekId = $request->id_kelompok_projek;
        
        $kelompokProjekDataProjek->delete();
        Alert::success('Kerja bagus', 'Data Projek berhasil dihapus!');
        
        return redirect()->route('kelompok_projek.show', $kelompokProjekId);
    }
}
