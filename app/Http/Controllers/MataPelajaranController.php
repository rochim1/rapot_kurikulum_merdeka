<?php

namespace App\Http\Controllers;

use App\Imports\MataPelajaranImport;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mata_pelajaran.index', [
            'mataPelajaran' => MataPelajaran::orderBy('kelompok', 'ASC')->orderBy('nama_mata_pelajaran', 'ASC')->get(),
            'title' => 'Mata Pelajaran'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mata_pelajaran.create', [
            'title' => 'Mata Pelajaran'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_mata_pelajaran' => 'required',
            'kelompok' => 'required|in:A,B,C',
        ]);

        MataPelajaran::create($validateData);
        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('mata_pelajaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('mata_pelajaran.edit', [
            'title' => 'Edit Mata Pelajaran',
            'mataPelajaran' => $mataPelajaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validateData = $request->validate([
            'nama_mata_pelajaran' => 'required',
            'kelompok' => 'required|in:A,B,C',
        ]);

        $mataPelajaran->update($validateData);
        Alert::success('Success', 'Data berhasil diperbarui!');
        return redirect()->route('mata_pelajaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        Alert::success('Success', 'Data berhasil dihapus!');
        return redirect()->route('mata_pelajaran.index');
    }

    public function import_mata_pelajaran(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]);
        
        try {
            Excel::import(new MataPelajaranImport, $request->file('file'));
            Alert::success('kerja bagus', 'Data berhasil diimport!');        
            return redirect()->route('mata_pelajaran.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());        
            return redirect()->route('mata_pelajaran.index');
        }
    }
}
