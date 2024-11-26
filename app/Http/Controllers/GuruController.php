<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
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
            'status' => 'nullable|string|in:Aktif,Tidak Aktif, Wali Kelas, Cuti, Mutasi, Pensiun',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'mata_pelajaran_id.exists' => 'Mata pelajaran tidak valid.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP maksimal 50 karakter.',
            'nrg.string' => 'NRG harus berupa teks.',
            'nrg.max' => 'NRG maksimal 50 karakter.',
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'jk.string' => 'Jenis kelamin harus berupa teks.',
            'jk.max' => 'Jenis kelamin maksimal 10 karakter.',
            'tempat_lahir.string' => 'Tempat lahir harus berupa teks.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 50 karakter.',
            'tgl_lahir.date' => 'Tanggal lahir harus berupa format tanggal yang valid.',
            'agama.string' => 'Agama harus berupa teks.',
            'agama.max' => 'Agama maksimal 50 karakter.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan maksimal 50 karakter.',
            'golongan.string' => 'Golongan harus berupa teks.',
            'golongan.max' => 'Golongan maksimal 50 karakter.',
            'tmt_awal.date' => 'TMT Awal harus berupa format tanggal yang valid.',
            'pendidikan_terakhir.string' => 'Pendidikan terakhir harus berupa teks.',
            'pendidikan_terakhir.max' => 'Pendidikan terakhir maksimal 50 karakter.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Status tidak valid. Pilihan yang tersedia: Aktif, Tidak Aktif, Wali Kelas, Cuti, Mutasi, Pensiun.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format file foto harus jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran file foto maksimal 2 MB.',
        ]);
        

        // Proses upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $uniqueName = time() . '_' . $originalName; // Menambahkan prefix timestamp untuk unik
            $fotoPath = $request->file('foto')->storeAs('foto-guru', $uniqueName, 'public');
        }

        // Membuat data user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->nip ? $request->nip . '@gmail.com' : strtolower(str_replace(' ', '.', $request->nama)) . '@gmail.com',
            'password' => Hash::make('guru'), // Password default
        ]);

        // Menetapkan role 'guru' ke user
        $user->assignRole('walas');

        // Menyimpan data guru dan menghubungkan dengan user
        $guru = Guru::create(array_merge($request->all(), ['id_user' => $user->id, 'foto' => $fotoPath,]));
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
            'status' => 'nullable|string|in:Aktif,Tidak Aktif,Wali Kelas,Cuti,Mutasi,Pensiun',
            // 'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'mata_pelajaran_id.exists' => 'Mata pelajaran tidak valid.',
            // 'foto.image' => 'File foto harus berupa gambar.',
            // 'foto.mimes' => 'Format file foto harus jpg, jpeg, atau png.',
            // 'foto.max' => 'Ukuran file foto maksimal 2 MB.',
        ]);

        // Ambil data lama
        $data = Guru::findOrFail($id_guru);

        // Cek jika ada file baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada di folder foto-guru
            if (!empty($data->foto) && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }

            // Simpan foto baru
            $originalName = $request->file('foto')->getClientOriginalName();
            $uniqueName = time() . '_' . $originalName;
            $fotoPath = $request->file('foto')->storeAs('foto-guru', $uniqueName, 'public');

            // Update path foto
            $data->foto = 'foto-guru/' . $uniqueName;
        }

        // Update data lainnya
        $data->nama = $request->nama;
        $data->mata_pelajaran_id = $request->mata_pelajaran_id;
        $data->nip = $request->nip;
        $data->nrg = $request->nrg;
        $data->jk = $request->jk;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->agama = $request->agama;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->jabatan = $request->jabatan;
        $data->golongan = $request->golongan;
        $data->tmt_awal = $request->tmt_awal;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;

        // Simpan perubahan
        $data->save();

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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods' // Validasi file
        ]);

        // Proses import
        Excel::import(new GuruImport, $request->file('file'));
        Alert::success('success', 'Data guru berhasil diimport.');
        return back()->with('success', 'Data Guru Berhasil Diimport!');
    }
    public function updateStatus(Request $request, $id_guru)
    {
        $request->validate([
            'status' => 'required|in:Aktif,Non-Aktif,Wali Kelas,Mutasi,Pensiun',
        ]);

        $guru = Guru::findOrFail($id_guru);
        $guru->status = $request->status;
        $guru->save();
        Alert::success('success', 'Status guru berhasil diperbarui.');
        return redirect()->back();
    }
}
