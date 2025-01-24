<?php
namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Models\Kelas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query for the 'kelas' table
        $query = Kelas::query();

        // Apply filters dynamically
        if ($request->filled('search')) {
            $search = $request->input('search');
            // Use DB::raw to concatenate fields and apply a filter
            $query->whereRaw("CONCAT(kelas_tingkatan, '.', kelas_abjad) LIKE ?", ["%$search%"]);
        }

        // Add ordering and paginate the results
        $kelas = $query->orderBy('kelas_tingkatan', 'asc')
            ->orderBy('fase', 'asc')
            ->orderBy('kelas_abjad', 'asc')
            ->paginate(10)
            ->withQueryString(); // Retain query parameters during pagination

        // Return the view with data and filters
        return view('kelas.index', [
            'kelas' => $kelas,
            'title' => 'Kelas'
        ]);
    }


    public function create()
    {
        return view('kelas.create', [
            'title' => 'Tambah Kelas',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $validateData = $request->validate([
            'kelas_tingkatan' => 'required|in:I,II,III,IV,V,VI',
            'kelas_abjad' => 'required|in:A,B,C,D,E,F',
            'fase' => 'required|in:A,B,C',
        ]);

        // Membuat data Kelas
        Kelas::create($validateData);

        Alert::success('Kerja bagus', 'Kelas berhasil disimpan!');
        if ($request->has('repeat')) {
            Alert::success('Kerja Bagus', 'Data berhasil ditambahkan, silakan tambahkan data baru.');
            return back();
        }
        return redirect()->route('kelas.index');
    }

    public function show(Kelas $kela)
    {
        // Menampilkan detail kelas jika diperlukan
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', [
            'title' => 'Edit Kelas',
            'kelas' => $kela,
        ]);
    }

    public function update(Request $request, Kelas $kela)
    {
        // Validasi inputan
        $validateData = $request->validate([
            'kelas_tingkatan' => 'required|in:I,II,III,IV,V,VI',
            'kelas_abjad' => 'required|in:A,B,C,D,E,F',
            'fase' => 'required|in:A,B,C',
        ]);

        // Mengupdate data kelas
        $kela->update($validateData);

        Alert::success('Kerja bagus', 'Kelas berhasil diperbarui!');
        return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kela)
    {
        // Menghapus data kelas
        $kela->delete();
        Alert::success('Kerja bagus', 'Kelas berhasil dihapus!');
        return redirect(  )->route('kelas.index');
    }

    public function import_kelas(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods'
        ]); 
    
        try {
            Excel::import(new KelasImport, $request->file('file'));
            Alert::success('Kerja bagus', 'Data berhasil diimport!');
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            Alert::error('Terjadi kesalahan saat mengimport data', $e->getMessage());
            return redirect()->route('kelas.index');
        }
    }
}
