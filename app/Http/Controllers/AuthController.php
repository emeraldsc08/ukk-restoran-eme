<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * function untuk authentikasi
     */
    private function signin(Request $request)
    {
        $user = Users::where('username', $request->input('username'))->first();
        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                $this->setSession($user);
                return redirect('/home')->with('auth_success', 'Berhasil masuk!');
            } else {
                return redirect()->back()->with('auth_err', 'Username / password salah!');
            }
        } else {
            return redirect()->back()->with('auth_err', 'Akun tidak ditemukan!');
        }
    }

    /**
     * function untuk set session
     */
    public function setSession($user)
    {
        Session::put('userid', $user->id);
        Session::put('username', $user->username);
        Session::put('level', $user->id_level);
        Session::put('status', TRUE);
    }

    /**
     * function untuk menampilkan view sign in
     */
    public function vSignin()
    {
        return view('auth.signin');
    }

    /**
     * function untuk validasi input sign in
     */
    public function validateSignin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        return $this->signin($request);
    }

    /**
     * function untuk logout
     */
    public function logout()
    {
        Session::flush();
        return redirect('/auth/signin');
    }
}
