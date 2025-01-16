<?php

namespace App\Http\Controllers\Auth;

use App\Models\Guru;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Http\Controllers\Controller;
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
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
            'id_tahun_ajaran.exists' => 'Tahun ajaran tidak valid.',
        ]);

        // Cek apakah email ada di database
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Mohon maaf, email yang anda masukan tidak terdaftar.');
        }

        // Cek apakah password sesuai
        if (!\Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error', 'Mohon maaf, password yang Anda masukkan salah.');
        }

        // Ambil input email dan password untuk proses login
        $credentials = $request->only('email', 'password');

        // Proses login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                Alert::success('Kerja Bagus!', 'Login Berhasil');
                return redirect()->intended(route('home', absolute: false));
            }

            if ($user->hasRole('walas')) {
                // Periksa apakah user walas telah mengisi tahun ajaran
                if (empty($request->id_tahun_ajaran)) {
                    Auth::logout(); // Logout user jika validasi gagal
                    Alert::error('Terjadi kesalahan!', 'Mohon maaf, Anda harus memilih tahun ajaran terlebih dahulu.');
                    return redirect()->route('login');
                }

                if ($user->guru->is_wali_kelas == true) {
                    $tahunAjaran = TahunAjaran::find($request->id_tahun_ajaran);
                    if (!$tahunAjaran) {
                        return redirect()->route('login')->with('error', 'Tahun ajaran tidak ditemukan.');
                    }

                    session(['id_tahun_ajaran' => $request->id_tahun_ajaran]);
                    Alert::success('Kerja Bagus!', 'Login Berhasil');
                    return redirect()->route('home')->with('success', 'Login berhasil');
                }

                Auth::logout();
                Alert::error('Terjadi kesalahan!', 'Mohon maaf, Anda bukan wali kelas. Hubungi admin jika membutuhkan akses masuk');
                return redirect()->route('login');
            }

            Auth::logout();
            return redirect()->route('login')->with('error', 'Role Anda tidak memiliki akses.');
        }

        // Jika kredensial salah, kembalikan ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->with('error', 'Email atau password salah.');
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
