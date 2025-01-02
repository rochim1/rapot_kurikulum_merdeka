<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilSekolah = ProfilSekolah::find(1);
        $title = 'Profil Sekolah';
        return view('profil_sekolah', compact('profilSekolah', 'title'));  
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
    public function show(ProfilSekolah $profilSekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilSekolah $profilSekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilSekolah $profilSekolah)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'akreditas' => 'required|string|max:10',
            'npsn' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nama_kepsek' => 'required|string|max:255',
            'nip_kepsek' => 'required|string|max:18',
            'pangkat_golongan_kepsek' => 'required|string|max:50',
            'ttd_tempat_tanggal_rapot' => 'required|string|max:255',
        ]);
    
        $profilSekolah->update($validated);
    
        Alert::success('Kerja Bagus', 'Data berhasil disimpan!');
        return redirect()->route('profil_sekolah.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilSekolah $profilSekolah)
    {
        //
    }
}
