<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\KelolaKelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\SiswaTahunAjaran;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check if the user is an admin
        $isAdmin = auth()->user()->hasRole('admin'); // Assuming you're using a role-based system like Spatie

        // Initialize $tahunAjaran to null for admins
        $tahunAjaran = null;
        $title = 'Home';

        // If the user is not an admin, proceed with the 'tahun_ajaran' logic
        if (!$isAdmin) {
            $id_tahun_ajaran = session('id_tahun_ajaran');
            if (!$id_tahun_ajaran) {
                return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
            }
            $tahunAjaran = TahunAjaran::find($id_tahun_ajaran);
            if (!$tahunAjaran) {
                return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
            }

            $kelola_kelas = KelolaKelas::with('kelas')
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->where('id_guru', auth()->user()->id)
                ->get();

            $total_siswa = 0;

            $kelola_kelas->each(function ($kelola) use (&$total_siswa) {
                $kelola->siswa = Siswa::whereIn('id_siswa', $kelola->daftar_id_siswa)->get();
                $total_siswa += $kelola->siswa->count();
            });

            $jumlahSiswa = $total_siswa;
        } else {
            // If the user is an admin, display all students regardless of 'tahun ajaran'
            $jumlahSiswa = Siswa::count(); // Assuming you have a Siswa model for students
        }
        $jumlahGuru = Guru::count();
        return view('home', compact('jumlahSiswa', 'tahunAjaran', 'title','jumlahGuru'));
    }
}
