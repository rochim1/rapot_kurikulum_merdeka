<?php

namespace App\Http\Controllers;

use App\Imports\TahunAjaranImport;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tahun_ajaran.index', [
            'tahunAjaran' => TahunAjaran::all(),
            'title' => 'Tahun Ajaran'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahun_ajaran.create', [
            'title' => 'Tambah Tahun Ajaran'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_tahun_ajaran' => 'required|max:50',
        ]);

        TahunAjaran::create($validatedData);
        Alert::success('Sukses', 'Tahun ajaran berhasil disimpan!');
        return redirect()->route('tahun_ajaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun_ajaran.edit', [
            'title' => 'Edit Tahun Ajaran',
            'tahunAjaran' => $tahunAjaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $validatedData = $request->validate([
            'nama_tahun_ajaran' => 'required|max:50',
        ]);

        $tahunAjaran->update($validatedData);
        Alert::success('Sukses', 'Tahun ajaran berhasil diperbarui!');
        return redirect()->route('tahun_ajaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->delete();
        Alert::success('Sukses', 'Tahun ajaran berhasil dihapus!');
        return redirect()->route('tahun_ajaran.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]);
        
        try {
            Excel::import(new TahunAjaranImport, $request->file('file'));
            Alert::success('kerja bagus', 'Data berhasil diimport!');        
            return redirect()->route('tahun_ajaran.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());        
            return redirect()->route('tahun_ajaran.index');
        }
    }
}
