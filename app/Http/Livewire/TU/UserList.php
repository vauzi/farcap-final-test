<?php

namespace App\Http\Livewire\TU;

use App\Models\Kelas;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserList extends Component
{
    use WithFileUploads;

    public $detail;

    public $nomor_induk;
    public $nama;
    public $foto;
    public $tgl_lahir;
    public $gender;
    public $jabatan;
    public $alamat;
    public $role;
    public $siswaKelas;

    public function render()
    {
        $profile = Profile::query()
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->whereNot('role_id', '=', 3)
            ->get();
        return view('livewire.t-u.user-list', ['data' => $profile,]);
    }
    public function getKelas()
    {
        $this->siswaKelas = Kelas::query()->get();
    }
    public function show($id)
    {
        $profile = Profile::query()
            ->where('users.id', $id)
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('profiles.*', 'profiles.id', 'users.role_id as role_id')
            ->first();
        $role = Role::query()->whereNot('id', 3)->get();
        $this->getKelas();

        $this->nomor_induk = $profile->nomor_induk;
        $this->nama = $profile->nama;
        $this->foto = $profile->foto;
        $this->tgl_lahir = $profile->tgl_lahir;
        $this->gender = $profile->gender;
        $this->jabatan = $profile->role_id;
        $this->alamat = $profile->alamat;
        $this->detail = $profile;
        $this->role = $role;
    }

    public function update($user_id)
    {
        $data = Profile::query()->find($user_id);
        $data->update([
            'nomor_induk'   => $this->nomor_induk,
            'nama'          => $this->nama,
            'tgl_lahir'     => $this->tgl_lahir,
            'gender'        => $this->gender,
            'alamat'        => $this->alamat
        ]);
        $user = User::query()->where('id', $data->user_id)->first();
        if ($user->role_id !== $this->role) {
            $user->update([
                'role_id'   => $this->jabatan
            ]);
        }
    }
    public function updateImage($user_id)
    {
        $profile = Profile::query()->where('user_id', $user_id);
        // dd($profile);
        // $file = str_replace($request->getSchemeAndHttpHost() . '/storage', '', $profile->foto);
        // Storage::delete($file);
        $image = $this->foto->store('image/profile', 'public');
        $profile->update([
            'foto'   => 'storage/' . $image,
        ]);
    }
    public function deleted($user_id)
    {
        $delete = Profile::query()->where('user_id', $user_id)->first();
        $delete->delete();
        session()->flash('succes', 'Data Berhasil Di Hapus!!');
    }
    public function clearRequest()
    {
        $this->nomor_induk = '';
        $this->nama = '';
        $this->foto = '';
        $this->tgl_lahir = '';
        $this->gender = '';
        $this->jabatan = '';
        $this->alamat = '';
    }
}
