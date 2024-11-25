<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::with('mata_pelajaran')->get();
        return view('components.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua mata pelajaran dari database
        $mataPelajarans = MataPelajaran::all();

        // Mengembalikan view dengan membawa data mata pelajaran
        return view('components.guru.create', compact('mataPelajarans'));
    }

    // Menyimpan data guru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'mata_pelajaran_id' => 'required|exists:tb_mata_pelajaran,id_mata_pelajaran',
            'nip' => 'nullable|string|max:50',
            'nrg' => 'nullable|string|max:50',
            'jk' => 'required|string|max:10',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'tmt_awal' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'is_wali_kelas' => 'nullable|string|in:Aktif,Tidak Aktif',
        ]);

        // Membuat data user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->nip ? $request->nip . '@gmail.com' : strtolower(str_replace(' ', '.', $request->nama)) . '@gmail.com',
            'password' => Hash::make('guru'), // Password default
        ]);

        // Menetapkan role 'guru' ke user
        $user->assignRole('walas');

        // Menyimpan data guru dan menghubungkan dengan user
        $guru = Guru::create(array_merge($request->all(), ['id_user' => $user->id]));
        return redirect()->route('data-guru')->with('success', 'Data guru berhasil disimpan dan user berhasil dibuat dengan role guru.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data guru berdasarkan ID
        $guru = Guru::findOrFail($id);

        // Kembalikan view dengan membawa data guru yang akan diedit
        return view('components.guru.edit', compact('guru'));
    }

    /**
     * Mengupdate data guru di database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
            'nrg' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:15',
            'jabatan' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:20',
            'tmt_awal' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'is_wali_kelas' => 'nullable|string|in:Aktif,Tidak Aktif',
        ]);

        // Cari guru berdasarkan ID dan update data
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        // Redirect ke halaman data guru dengan pesan sukses
        return redirect()->route('data-guru')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru=Guru::findOrFile($id);
        $guru->delete();
        return redirect()->route('data-guru')->with('success','Data guru berhasil dihapus');
    }
}
