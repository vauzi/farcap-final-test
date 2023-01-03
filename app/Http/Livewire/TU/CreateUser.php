<?php

namespace App\Http\Livewire\TU;

use App\Models\Kelas;
use App\Models\Profile;
use App\Models\Role;
use App\Models\SiswaKelas;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithFileUploads;

    public $nomor_induk;
    public $nama;
    public $foto;
    public $tgl_lahir;
    public $gender;
    public $jabatan;
    public $alamat;
    public $kelas;

    protected $rules = [
        'nomor_induk'   => 'required|min:3|unique:profiles',
        'nama'          => 'required|min:3',
        'foto'          => 'required|image|image|mimes:jpg,png,jpeg,svg',
        'tgl_lahir'     => 'required',
        'gender'        => 'required',
        'jabatan'       => 'required',
        'alamat'        => 'required'
    ];
    protected $messages = [
        'required'  => ':attribute tidak boleh kosong',
        'min'       => ':attribute minimal :min karakter',
        'image'     => ':attribute harus berupa gambar/foto',
        'mimes'     => ':attribute format file harus :value',
        'unique'    => ':attribute sudah terdaftar',
    ];
    public function getKelas()
    {
        $kelas = Kelas::query()->get();
        return $kelas;
    }
    public function render()
    {
        $kelas = $this->getKelas();
        $role = Role::query()->get();
        return view('livewire.t-u.create-user', [
            'role' => $role,
            'siswaKelas' => $kelas,
        ]);
    }

    public function submited()
    {
        $this->validate();
        $image = '';
        if ($this->foto !== null) {
            $image = $this->foto->store('image/profile', 'public');
        }
        $user = User::query()->create([
            'username' => $this->nomor_induk,
            'password' => $this->nomor_induk,
            'role_id'  => $this->jabatan
        ]);
        if ($user->id !== null) {
            Profile::query()->create([
                'user_id'       => $user->id,
                'nomor_induk'   => $this->nomor_induk,
                'nama'          => $this->nama,
                'foto'          => 'storage/' . $image,
                'tgl_lahir'     => $this->tgl_lahir,
                'gender'        => $this->gender,
                'alamat'        => $this->alamat
            ]);
        }
        if ($this->kelas !== null) {
            SiswaKelas::query()->create([
                'user_id'   => $user->id,
                'kelas_id'  => $this->kelas
            ]);
        }
        session()->flash('succes', 'Berhasil Menambahkan Data!!');
        $this->clearRequest();
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
