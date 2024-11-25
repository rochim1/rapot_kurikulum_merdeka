<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
        Alert::success('success', 'Data guru berhasil disimpan dan user berhasil dibuat dengan role guru.');
        return redirect()->route('data-guru');
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
    public function edit($id_guru)
    {
        $guru = Guru::findOrFail($id_guru);
        $mataPelajarans = MataPelajaran::all();
        return view('components.guru.edit', compact('guru', 'mataPelajarans'));
    }

    public function update(Request $request, $id_guru)
    {
        $guru = Guru::findOrFail($id_guru);

        $request->validate([
            'nama' => 'required|string|max:100',
            'mata_pelajaran_id' => 'nullable|exists:tb_mata_pelajaran,id_mata_pelajaran',
            // Validasi lainnya
        ]);

        $guru->update($request->all());
        Alert::success('success', 'Data guru berhasil diperbarui.');
        return redirect()->route('data-guru');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_guru)
    {
        $guru=Guru::find($id_guru);
        $guru->delete();
        Alert::success('success','Data guru berhasil dihapus');
        return redirect()->route('data-guru');
    }
}
