<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListBuku extends Component
{
    public function getAllBook()
    {
        $id = Auth::user()->id;
        $buku = Buku::query()
            ->join('users', 'users.id', '=', 'bukus.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->join('kelas', 'kelas.id', '=', 'kelas_id')
            ->join('siswa_kelas', 'siswa_kelas.kelas_id', '=', 'kelas.id')
            ->where('siswa_kelas.user_id', '=', $id)
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
        $buku = $this->getAllBook();
        return view('livewire.siswa.list-buku', ['data' => $buku]);
    }
}
