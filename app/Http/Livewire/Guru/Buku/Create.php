<?php

namespace App\Http\Livewire\Guru\Buku;

use App\Models\Buku;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $judul, $cover, $kelas, $semester, $deskripsi;

    protected $rules = [
        'judul'     => 'required|min:3',
        'cover'     => 'required|image|image|mimes:jpg,png,jpeg,svg',
        'semester'  => 'required',
        'deskripsi' => 'required',
    ];
    protected $messages = [
        'required'  => ':attribute tidak boleh kosong',
        'min'       => ':attribute minimal :min karakter',
        'image'     => ':attribute harus berupa gambar/foto',
        'mimes'     => ':attribute format file harus :value'
    ];

    public function render()
    {
        $kelas = Kelas::query()->get();
        return view('livewire.guru.buku.create', ['data' => $kelas]);
    }
    public function submited()
    {
        $this->validate();
        $user_id = Auth::user()->id;
        $image = '';
        if ($this->cover !== null) {
            $image = $this->cover->store('image/profile', 'public');
        }
        Buku::query()->create([
            'user_id' => $user_id,
            'kelas_id' => $this->kelas,
            'judul' => $this->judul,
            'foto'  => 'storage/' . $image,
            'semester' => $this->semester,
            'deskripsi' => $this->deskripsi,
        ]);
        session()->flash('succes', 'Bab Buku Telah Berhasil Di Tambahakan');
    }
}
