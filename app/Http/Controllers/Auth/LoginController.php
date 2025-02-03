<?php

namespace App\Http\Controllers\Auth;

use App\Models\Guru;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Http\Controllers\Controller;
use App\Models\KelolaKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        $sekolah = ProfilSekolah::first();
        session(['data_sekolah' => $sekolah]);
        $tahunAjaran = TahunAjaran::all();
        
        return view('auth.login', compact('tahunAjaran'));
    }

    /**
     * Handle the login attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'id_tahun_ajaran' => 'nullable|exists:tb_tahun_ajaran,id_tahun_ajaran',
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email harus berupa format email yang valid.',
            'password.required' => 'Password tidak boleh kosong.',
            'id_tahun_ajaran.exists' => 'Tahun ajaran tidak valid.',
        ]);

        // Proses login
        if (!Auth::attempt($request->only('email', 'password'))) {
            Alert::error('Terjadi kesalahan!', 'Mohon maaf, Email / password yang Anda masukkan salah.');
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Admin Login
        if ($user->hasRole('admin')) {
            Alert::success('Kerja Bagus!', 'Login Berhasil');
            return redirect()->route('home');
        }

        // Wali Kelas Login
        if ($user->hasRole('walas')) {
            // Pastikan tahun ajaran valid
            if (!$request->id_tahun_ajaran) {
                Auth::logout();
                Alert::error('Terjadi kesalahan!', 'Mohon maaf, Anda harus memilih tahun ajaran terlebih dahulu.');
                return redirect()->route('login');
            }

            $tahunAjaran = TahunAjaran::find($request->id_tahun_ajaran);
            if (!$tahunAjaran || !$tahunAjaran->is_active) {
                Auth::logout();
                Alert::error('Terjadi kesalahan!', 'Hubungi admin untuk mengaktifkan Tahun Ajaran.');
                return redirect()->route('login');
            }

            // Ambil data guru berdasarkan user
            $guru = Guru::where('id_user', $user->id)->first();
            if (!$guru) {
                Auth::logout();
                Alert::error('Terjadi kesalahan!', 'Data guru tidak ditemukan.');
                return redirect()->route('login');
            }

            if ($guru->status == 'deleted') {
                Auth::logout();
                Alert::error('Terjadi kesalahan!', 'Mohon maaf, status guru non aktif/dihapus.');
                return redirect()->route('login');
            }

            // Cek apakah dia wali kelas pada tahun ajaran yang dipilih
            $kelola_kelas = KelolaKelas::where([
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_guru' => $guru->id_guru
            ])->first();

            if (!$kelola_kelas) {
                Auth::logout();
                Alert::error('Terjadi kesalahan!', 'Anda bukan wali kelas pada tahun ajaran ' 
                    . $tahunAjaran->tahun_ajaran_awal . '/' . $tahunAjaran->tahun_ajaran_akhir 
                    . ' - ' . $tahunAjaran->semester
                );
                return redirect()->route('login');
            }

            // Simpan data ke sesi
            session([
                'id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran,
                'id_kelas' => $kelola_kelas->id_kelas,
                'id_guru' => $guru->id_guru
            ]);

            Alert::success('Kerja Bagus!', 'Login Berhasil');
            return redirect()->route('home');
        }

        // Jika role tidak dikenali
        Auth::logout();
        Alert::error('Terjadi kesalahan!', 'Mohon maaf, Hubungi admin Website.');
        return redirect()->route('login');
    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $request->session()->forget('id_tahun_ajaran');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        Alert::success('Kerja Bagus', 'Anda Berhasil Logout')->autoClose(false);
        return redirect()->route('login');
    }
}
