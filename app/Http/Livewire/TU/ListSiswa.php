<?php

namespace App\Http\Livewire\TU;

use App\Models\Profile;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListSiswa extends Component
{
    use WithFileUploads;
    public $siswa;

    public $nomor_induk;
    public $nama;
    public $foto;
    public $tgl_lahir;
    public $gender;
    public $alamat;
    public function getSiswa()
    {
        $siswa = Profile::query()
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('siswa_kelas', 'siswa_kelas.user_id', '=', 'profiles.user_id')
            ->join('kelas', 'kelas.id', '=', 'siswa_kelas.kelas_id')
            ->where('role_id', 3)
            ->get();
        return $siswa;
    }
    public function render()
    {
        $siswa = $this->getSiswa();
        return view('livewire.t-u.list-siswa', ['data' => $siswa]);
    }
    public function show($user_id)
    {
        $profile = Profile::query()
            ->where('users.id', $user_id)
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('profiles.*', 'profiles.id', 'users.role_id as role_id')
            ->first();

        $this->nomor_induk = $profile->nomor_induk;
        $this->nama = $profile->nama;
        $this->foto = $profile->foto;
        $this->tgl_lahir = $profile->tgl_lahir;
        $this->gender = $profile->gender;
        $this->alamat = $profile->alamat;
        $this->siswa = $profile;
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
        session()->flash('succes', 'Foto Berhasil Di ubah!!');
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
        session()->flash('succes', 'Data Berhasil Di ubah!!');
        // $user = User::query()->where('id', $data->user_id)->first();
        // if ($user->role_id !== $this->role) {
        //     $user->update([
        //         'role_id'   => $this->jabatan
        //     ]);
        // }
    }
}
