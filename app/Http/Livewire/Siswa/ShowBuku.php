<?php

namespace App\Http\Livewire\Siswa;

use App\Models\BabBuku;
use App\Models\Buku;
use Livewire\Component;

class ShowBuku extends Component
{
    public $serchBab = 'BAB I';
    public $buku_id;
    public function mount($buku_id)
    {
        $this->buku_id = $buku_id;
    }
    public function getBabByIdBuku()
    {
        $bab = BabBuku::query()
            ->where('buku_id', $this->buku_id)
            ->where('nama_bab', $this->serchBab)
            ->get();
        return $bab;
    }
    public function getBukuById()
    {
        $buku = Buku::query()
            ->where('bukus.id', $this->buku_id)
            ->join('users', 'users.id', '=', 'bukus.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->join('kelas', 'kelas.id', '=', 'kelas_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
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
                'users.id as user_id',
                'kelas.kelas',
                'bukus.semester'
            ])
            ->first();
        return $buku;
    }
    public function render()
    {
        $bab = $this->getBabByIdBuku();
        $buku = $this->getBukuById();
        return view('livewire.siswa.show-buku', [
            'bab' => $bab,
            'buku' => $buku
        ]);
    }
}
