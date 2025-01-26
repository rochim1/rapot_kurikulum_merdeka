<?php

namespace App\Http\Controllers;

use App\Imports\TargetCapaianImport;
use App\Models\TargetCapaian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TargetCapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menampilkan semua data TargetCapaian
        $query = TargetCapaian::query();
        
        if ($request->filled('dimensi')) {
            $query->where('dimensi', 'like', '%' . $request->input('dimensi') . '%');
        }

        if ($request->filled('elemen')) {
            $query->where('elemen', 'like', '%' . $request->input('elemen') . '%');
        }

        if ($request->filled('sub_elemen')) {
            $query->where('sub_elemen', 'like', '%' . $request->input('sub_elemen') . '%');
        }
        
        $targetCapaian = $query->orderBy('dimensi', 'ASC')->orderBy('elemen', 'ASC')->paginate(10);
        $title = 'Target Capaian';
        
        return view('target_capaian.index', compact('targetCapaian', 'title')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('target_capaian.create', [
            'title' => 'Tambah Target Capaian',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'dimensi' => 'nullable|string',
            'elemen' => 'nullable|string',
            'sub_elemen' => 'nullable|string',
            'capaian_akhir_fase' => 'nullable|string',
        ]);

        // Menyimpan data ke dalam database
        $targetCapaian = TargetCapaian::create([
            'dimensi' => $request->dimensi,
            'elemen' => $request->elemen,
            'sub_elemen' => $request->sub_elemen,
            'capaian_akhir_fase' => $request->capaian_akhir_fase,
        ]);

        Alert::success('Sukses', 'Data berhasil disimpan!');
        return redirect()->route('target_capaian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TargetCapaian $targetCapaian)
    {
        return view('target_capaian.show', [
            'title' => 'Detail Target Capaian',
            'targetCapaian' => $targetCapaian,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetCapaian $targetCapaian)
    {
        return view('target_capaian.edit', [
            'title' => 'Edit Target Capaian',
            'targetCapaian' => $targetCapaian,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TargetCapaian $targetCapaian)
    {
        // Validasi data yang diterima
        $request->validate([
            'dimensi' => 'nullable|string',
            'elemen' => 'nullable|string',
            'sub_elemen' => 'nullable|string',
            'capaian_akhir_fase' => 'nullable|string',
        ]);

        // Update data yang ada dengan inputan baru
        $targetCapaian->update([
            'dimensi' => $request->dimensi ?? $targetCapaian->dimensi,
            'elemen' => $request->elemen ?? $targetCapaian->elemen,
            'sub_elemen' => $request->sub_elemen ?? $targetCapaian->sub_elemen,
            'capaian_akhir_fase' => $request->capaian_akhir_fase ?? $targetCapaian->capaian_akhir_fase,
        ]);

        Alert::success('Kerja bagus', 'Kelas berhasil diperbarui!');
        return redirect()->route('target_capaian.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetCapaian $targetCapaian)
    {
        // Hapus data
        $targetCapaian->delete();
        Alert::success('Kerja bagus', 'Target Capaian berhasil dihapus!');
        return redirect(  )->route('target_capaian.index');
    }

    public function import_target_capaian(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]); 
    
        try {
            Excel::import(new TargetCapaianImport, $request->file('file'));
            Alert::success('Kerja bagus', 'Data berhasil diimport!');
            return redirect()->route('target_capaian.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());
            return redirect()->route('target_capaian.index');
        }
    }
}
