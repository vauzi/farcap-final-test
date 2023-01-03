<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public function render()
    {
        return view('livewire.auth.login');
    }
    protected $rules = [
        'username' => 'required|min:4',
        'password' => 'required|min:4',
    ];
    protected $messages = [
        'required' => ':attribute tidak boleh kosong',
        'min'   => ':attribute minimal :min karakter',
    ];
    public function login()
    {
        $this->validate();
        $credentials = [
            'username' => $this->username,
            'password' => $this->password
        ];

        $user = User::query()->where('username', '=', $credentials['username'])->first();

        if ($user && Hash::check($this->password, $user->password)) {
            if (Auth::attempt($credentials)) {
                session()->flash('succes', 'Login Berhasil');
                if (Auth::user()->role_id === 1) {
                    return redirect()->intended('/tu/dashboard')->with('success', 'Login Berhasil');
                }
                if (Auth::user()->role_id === 2) {
                    return redirect()->intended('/guru/dashboard')->with('success', 'Login Berhasil');
                }
                if (Auth::user()->role_id === 3) {
                    return redirect()->intended('/siswa/dashboard')->with('success', 'Login Berhasil');
                }
            }
        } else {
            session()->flash('error', 'Username or password Salah!!');
        }
    }
    public function Logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
