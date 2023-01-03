<?php

namespace App\Http\Livewire\Guru;

use App\Models\Buku as ModelsBuku;
use Livewire\Component;

class Buku extends Component
{
    public function getAllBuku()
    {
        $buku = ModelsBuku::query()
            ->join('users', 'users.id', '=', 'bukus.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->join('kelas', 'kelas.id', '=', 'kelas_id')
            ->select([
                'profiles.foto as foto_profile',
                'bukus.foto as foto',
                'bukus.judul as judul',
                'bukus.deskripsi as deskripsi',
                'profiles.nama as nama_penginput',
                'roles.role as jabatan',
                'bukus.id as buku_id',
                'bukus.created_at as time',
                'bukus.active as active',
                'kelas.kelas',
                'bukus.semester'
            ])
            ->get();
        return $buku;
    }
    public function render()
    {
        $buku = $this->getAllBuku();
        // dd($buku);
        return view('livewire.guru.buku', ['data' => $buku]);
    }
}
