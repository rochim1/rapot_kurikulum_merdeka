<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfilController extends Controller
{
    public function profilAdmin()
    {
        return view('profil_user', [
            'title' => 'Profil Admin'
        ]);
    }

    public function updateProfilUser(Request $request, User $user)
    {
        if (Hash::check($request->password_lama, auth()->user()->password)) {

            if (isset($request->password_baru)) {
                User::where($user->id)->update([
                    'password' => bcrypt($request->password_baru)
                ]);
            }
            
            Alert::success('kerja bagus', 'Password berhasil diperbarui!');
            return redirect()->route('profil_user.index');
        }

        Alert::error('Kerja Buruk', 'Password Lama Salah!');
        return redirect()->route('profil_user.index');
    }
}
