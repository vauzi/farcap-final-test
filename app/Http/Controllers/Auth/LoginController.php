<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|min:3',
                'password' => 'required|min:6',
            ],
            [
                'required' => ':attribute harus di isi',
                'min'   => ':attribute minmal :min karakter'
            ]
        );
        $username = $request->input('username');
        $pass = $request->input('password');
        $user = User::query()->where('username', '=', $username)->first();

        if ($user == null) {
            return redirect()->route('auth.form')->with('error', 'username tidak terdaftar');
        }
        if (Auth::attempt(['username' => $username, 'password' => $pass])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'password' => 'Password salah',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.form');
    }
}
