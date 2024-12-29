<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
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

        // If the user is not an admin, proceed with the 'tahun_ajaran' logic
        if (!$isAdmin) {
            $tahunAjaranId = session('nama_tahun_ajaran');
            if (!$tahunAjaranId) {
                return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
            }
            $tahunAjaran = TahunAjaran::find($tahunAjaranId);
            if (!$tahunAjaran) {
                return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
            }
            $jumlahSiswa = $tahunAjaran->siswa->count();
        } else {
            // If the user is an admin, display all students regardless of 'tahun ajaran'
            $jumlahSiswa = Siswa::count(); // Assuming you have a Siswa model for students
        }
        return view('home', compact('jumlahSiswa', 'tahunAjaran'));
    }
}
