<?php

namespace App\Http\Controllers;

use App\Models\DataProjek;
use App\Models\DataProjekTargetCapaian;
use App\Models\TargetCapaian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataProjekTargetCapaianController extends Controller
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
            'id_data_projek' => 'required',
            'id_target_capaian' => 'required',
        ]);

        DataProjekTargetCapaian::create([
            'id_data_projek' => $request->id_data_projek,
            'id_target_capaian' => $request->id_target_capaian,
        ]);

        Alert::success('Kerja Bagus', 'Data berhasil ditambahkan');
        $dataProjekId = $request->id_data_projek;
        return redirect()->route('data_projek.show', $dataProjekId);
    }


    /**
     * Display the specified resource.
     */
    public function show(DataProjekTargetCapaian $dataProjekTargetCapaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataProjekTargetCapaian $dataProjekTargetCapaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataProjekTargetCapaian $dataProjekTargetCapaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataProjekTargetCapaian $dataProjekTargetCapaian, Request $request)
    {
        $dataProjekId = $request->id_data_projek;
        
        $dataProjekTargetCapaian->delete();
        Alert::success('Kerja bagus', 'Data Projek berhasil dihapus!');
        
        return redirect()->route('data_projek.show', $dataProjekId);
    }
}
