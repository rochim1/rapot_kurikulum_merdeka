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
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
            'id_tahun_ajaran.exists' => 'Tahun ajaran tidak valid.',
        ]);

        $credentials = $request->only('email', 'password');
        // Proses login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                Alert::success('Kerja Bagus!', 'Login Berhasil');
                return redirect()->route('home');
            } 
            else if($user->hasRole('walas')) {
                $tahunAjaran = TahunAjaran::find($request->id_tahun_ajaran);
                
                if($tahunAjaran){
                    $kelola_kelas = KelolaKelas::where('id_tahun_ajaran', $request->id_tahun_ajaran)
                        ->where('id_guru', auth()->user()->id)
                        ->first();
                        
                    // cek apa dia wali kelasnya?
                    if($kelola_kelas) {
                        session(['id_tahun_ajaran' => $kelola_kelas->id_tahun_ajaran]);
                        session(['id_kelas' => $kelola_kelas->id_kelas]);
                        Alert::success('Kerja Bagus!', 'Login Berhasil');
                        return redirect()->route('home');
                    } else {
                        Auth::logout();
                        Alert::error('Terjadi kesalahan!', 'Anda bukan wali kelas pada tahun ajaran ' 
                                                            . $tahunAjaran->tahun_ajaran_awal 
                                                            . '/'. $tahunAjaran->tahun_ajaran_akhir 
                                                            . ' - ' . $tahunAjaran->semester
                                    );
                        return redirect()->route('login');
                    }
                    
                

                } else if (!$tahunAjaran) {
                    Auth::logout();
                    Alert::error('Terjadi kesalahan!', 'Mohon maaf, Anda harus memilih tahun ajaran terlebih dahulu');
                    return redirect()->route('login');
                } 
                else if(!$tahunAjaran->is_active) {
                    Auth::logout();
                    Alert::error('Terjadi kesalahan!', 'Hubungi admin untuk mengaktifkan Tahun Ajaran');
                    return redirect()->route('login');
                }  
                else {
                    Auth::logout();
                    Alert::error('Terjadi kesalahan!', 'Mohon maaf, Hubungi admin Website.');
                    return redirect()->route('login');
                }
            }
            

        } else {
            Auth::logout();
            Alert::error('Terjadi kesalahan!', 'Mohon maaf, Email / password yang Anda masukkan salah.');
            return redirect()->route('login');
        }

        // Login Wali Kelas


        
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
