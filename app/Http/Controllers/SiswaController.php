<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.index', [
            'siswa' => Siswa::all(), 
            'title' => 'Siswa']
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create', [
            'title' => 'siswa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required|unique:tb_siswa,nis',
            'nisn' => 'nullable|unique:tb_siswa,nisn',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'nullable|max:50',
            'nama_ayah' => 'nullable|max:100',
            'nama_ibu' => 'nullable|max:100',
            'no_telp_ortu' => 'nullable|max:100',
            'alamat' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,berhenti,mutasi,pensiun',
        ]);

        if ($request->file('foto')) {
            if ($request->foto) {
                $validateData['foto'] = Storage::put('foto-siswa', $request->file('foto'));
            }
        }

        Siswa::create($validateData);

        Alert::success('kerja bagus', 'Data berhasil disimpan!');
        return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', [
            'title' => 'siswa',
            'siswa' => $siswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', [
            'title' => 'siswa',
            'siswa' => $siswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required',
            'nisn' => 'nullable',
            'tempat_lahir' => 'nullable|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'nullable|max:50',
            'nama_ayah' => 'nullable|max:100',
            'nama_ibu' => 'nullable|max:100',
            'no_telp_ortu' => 'nullable|max:100',
            'alamat' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,berhenti,mutasi,pensiun',
        ]);

        if ($request->file('foto')) {
            if ($request->foto) {
                if (Storage::exists($siswa->foto)) {
                    Storage::delete($siswa->foto);
                }
                $validateData['foto'] = Storage::put('foto-siswa', $request->file('foto'));
            }
        }

        $siswa->update($validateData);
        Alert::success('kerja bagus', 'Data berhasil disimpan!');
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto) {
            if (Storage::exists($siswa->foto)) {
                Storage::delete($siswa->foto);
            }
        }

        $siswa->delete();
        Alert::success('kerja bagus', 'Data berhasil dihapus!');
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
