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
            'title' => 'Edit User',
            'user' => auth()->user(),
        ]);
    }

    public function updateProfilUser(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ], [
            'required' =>  ':attribute tidak boleh kosong!',
            'email' => ':attribute tidak sesuai!',
            'max' => ':attribute terlalu panjang!',
            'unique' => ':attribute sudah ada!',
            'confirmed' => ':attribute password tidak sesuai!',
            'min' => ':attribute harus lebih 8 karakter!',
        ]);

        if (isset($request->password)) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ], [
                'unique' => ':attribute sudah ada!',
                'confirmed' => ':attribute password tidak sesuai!',
                'min' => ':attribute harus lebih 8 karakter!',
            ]);

            User::find($user->id)->update([
                'password' => Hash::make($request['password']),
            ]);
        }

        User::find($user->id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        Alert::success('Sukses', 'Profil berhasil diperbarui');
        return redirect()->route('profil_user.index');
    }
}
