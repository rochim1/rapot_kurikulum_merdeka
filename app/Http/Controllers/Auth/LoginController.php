<?php

namespace App\Http\Controllers\Auth;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
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
        $tahunAjaran=TahunAjaran::all();
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
            'id_tahun_ajaran' => 'exists:tb_tahun_ajaran,id_tahun_ajaran',
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email harus berupa format email yang valid.',
            'password.required' => 'Password tidak boleh kosong.',
            'id_tahun_ajaran.exists' => 'Tahun ajaran tidak valid.',
        ]);
    
        // Ambil input email dan password untuk proses login
        $credentials = $request->only('email', 'password');
    
        // Proses login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->intended(route('home', absolute: false));
            }
            if ($user->hasRole('walas') && $user->guru->is_wali_kelas == true) {
                session(['id_tahun_ajaran' => $request->id_tahun_ajaran]);

                return redirect()->route('home')->with('success', 'Login berhasil!');
            }
            Auth::logout();
            Alert::error('Terjadi kesalahan!', 'Mohon maaf, Anda bukan wali kelas. Hubungi admin jika membutuhkan akses masuk');
            return redirect()->route('login');
        }
    
        // Jika kredensial salah, kembalikan ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->with('error', 'Email atau password salah.');
    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
