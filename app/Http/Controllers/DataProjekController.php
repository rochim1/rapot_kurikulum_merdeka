<?php

namespace App\Http\Controllers;

use App\Models\DataProjek;
use App\Models\DataProjekTargetCapaian;
use App\Models\TargetCapaian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProjek = DataProjek::orderBy('created_at', 'DESC')->paginate(10);
        $title = 'Data Projek';
        return view('data_projek.index', compact('dataProjek', 'title')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_projek.create', [
            'title' => 'Tambah Data Projek',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DataProjek::create([
            'tema' => $request->tema,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::success('Sukses', 'Data berhasil disimpan!');
        return redirect()->route('data_projek.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataProjek $dataProjek)
    {   
        return view('data_projek.show', [
            'title' => 'Data Projek',
            'dataProjek' => $dataProjek,
            'dataProjekTargetCapaian' => DataProjekTargetCapaian::with('targetCapaian')->where('id_data_projek', $dataProjek->id_data_projek)->get(),
            'targetCapaianList' => TargetCapaian::orderBy('dimensi', 'ASC')->orderBy('elemen', 'ASC')->get(),
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataProjek $dataProjek)
    {
        return view('data_projek.edit', [
            'title' => 'Edit Data Projek',
            'dataProjek' => $dataProjek,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataProjek $dataProjek)
    {
        $request->validate([
            'tema' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $dataProjek->update([
            'tema' => $request->tema ?? $dataProjek->tema,
            'nama' => $request->nama ?? $dataProjek->nama,
            'deskripsi' => $request->deskripsi ?? $dataProjek->deskripsi,
        ]);

        Alert::success('Kerja bagus', 'Kelas berhasil diperbarui!');
        return redirect()->route('data_projek.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataProjek $dataProjek)
    {
        $dataProjek->delete();
        Alert::success('Kerja bagus', 'Data Projek berhasil dihapus!');
        return redirect(  )->route('data_projek.index');
    }
}