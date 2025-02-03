<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start building the query for 'guru' with relationships 'user' and 'mata_pelajaran'
        $query = Guru::with('user', 'mata_pelajaran')->where('status', '=', 'Aktif');

        // Apply filters based on user input
        if ($request->filled('nama_guru')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('nama_guru') . '%');
            });
        }

        if (request()->filled('nip')) {
            $query->where('nip', 'like', '%' . request('nip') . '%');
        }

        if (request()->filled('nrg')) {
            $query->where('nrg', 'like', '%' . request('nrg') . '%');
        }

        if ($request->filled('mata_pelajaran')) {
            $query->whereHas('mata_pelajaran', function ($query) use ($request) {
                $query->where('nama_mata_pelajaran', 'like', '%' . $request->input('mata_pelajaran') . '%');
            });
        }

        // Paginate the results with query strings preserved
        $gurus = $query->orderBy('updated_at', 'ASC')  // You can change this to sort by other columns as needed
            ->paginate(10)
            ->withQueryString();  // Retain query parameters during pagination

        // Title for the page
        $title = 'Guru';

        // Return the view with data and filters
        return view('guru.index', compact('gurus', 'title'))
            ->with('filters', $request->only('nama_guru', 'mata_pelajaran'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua mata pelajaran dari database
        $mataPelajarans = MataPelajaran::orderBy('kelompok', 'ASC')->orderBy('nama_mata_pelajaran', 'ASC')->get();
        $title = 'Guru';

        // Mengembalikan view dengan membawa data mata pelajaran
        return view('guru.create', compact('mataPelajarans', 'title'));
    }

    // Menyimpan data guru
    public function store(Request $request)
    {
        DB::enableQueryLog();
        $request->validate([
            // 'nama' => 'required|string|max:100',
            'mata_pelajaran_id' => 'nullable|exists:tb_mata_pelajaran,id_mata_pelajaran',
            'nip' => 'nullable|string|max:50',
            'nrg' => 'nullable|string|max:50',
            'jk' => 'required|string|max:10',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            // 'email' => 'required',
            'jabatan' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'tmt_awal' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'status' => 'nullable|string|in:Aktif,Tidak Aktif, Wali Kelas, Cuti, Mutasi, Pensiun',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            // 'nama.max' => 'Nama maksimal 100 karakter.',
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
            'email.required' => 'Email haru diisi.',
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
            'email' => $request->email,
            'password' => Hash::make('guru'), // Password default
            'is_wali_kelas' => $request->status,
        ]);

        // Menetapkan role 'guru' ke user
        $user->assignRole('walas');

        // Menyimpan data guru dan menghubungkan dengan user
        $guru = Guru::create([
            'id_user' => $user->id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            // 'nama' => $request->nama,
            'nip' => $request->nip,
            'nrg' => $request->nrg,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            // 'email' => $request->email,
            'jabatan' => $request->jabatan,
            'golongan' => $request->golongan,
            'tmt_awal' => $request->tmt_awal,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'foto' => $fotoPath,
            'status' => 'Aktif'
        ]);
        Alert::success('success', 'Data guru berhasil disimpan dan user berhasil dibuat dengan role guru.');
        return redirect()->route('data-guru');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_guru)
    {
        $title = 'Guru';
        $guru = Guru::with('user', 'mata_pelajaran')->where('id_guru', $id_guru)->where('status', '=', 'Aktif')->firstOrFail();
        return view('guru.show', compact('guru', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_guru)
    {
        $title = 'Guru';
        $guru = Guru::where('status', '=', 'Aktif')->findOrFail($id_guru);
        $mataPelajarans =  MataPelajaran::orderBy('kelompok', 'ASC')->orderBy('nama_mata_pelajaran', 'ASC')->get();
        return view('guru.edit', compact('guru', 'mataPelajarans','title'));
    }

    public function update(Request $request, $id_guru)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'mata_pelajaran_id' => 'nullable|exists:tb_mata_pelajaran,id_mata_pelajaran',
            'nip' => 'nullable|string|max:50',
            'nrg' => 'nullable|string|max:50',
            'jk' => 'required|string|max:10',
            'tempat_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email',
            'jabatan' => 'nullable|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'tmt_awal' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'status' => 'nullable|string|in:Aktif,Tidak Aktif,Wali Kelas,Cuti,Mutasi,Pensiun',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil data lama
        $data = Guru::findOrFail($id_guru);

        // Cek jika ada file baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
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

        // Update data guru
        $data->update([
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'nip' => $request->nip,
            'nrg' => $request->nrg,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'jabatan' => $request->jabatan,
            'golongan' => $request->golongan,
            'tmt_awal' => $request->tmt_awal,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'status' => $request->status,
            'foto' => $data->foto, // Pastikan foto diperbarui jika ada
        ]);

        // Update data user terkait dengan guru
        if ($data->user) {
            $data->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        Alert::success('Success', 'Data guru berhasil diperbarui.');
        return redirect()->route('data-guru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_guru)
    {
        $user = DB::table('users')->where('id', $id_guru)->first();

        if (!$user) {
            Alert::error('Error', 'Data guru tidak ditemukan');
            return redirect()->route('data-guru');
        }

        // Update status and set deleted_at timestamp
        DB::table('users')
            ->where('id', $id_guru)
            ->update([
                'status' => 'Non-Aktif',
                'deleted_at' => now() // Soft delete manually
            ]);

        Alert::success('Success', 'Data guru berhasil dihapus');
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

    public function updateWaliKelas(Request $request, $id_guru)
    {
        $guru = Guru::findOrFail($id_guru);
        $guru->is_wali_kelas = $request->has('is_wali_kelas'); // Simpan `true` jika checkbox aktif
        $guru->save();

        return redirect()->back()->with('success', 'Status wali kelas berhasil diperbarui.');
    }

}
