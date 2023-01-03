<?php

namespace App\Http\Livewire\Guru\BabBuku;

use App\Models\BabBuku;
use App\Models\Buku;
use Livewire\Component;

class ListBabBuku extends Component
{
    public $serchBab = 'BAB I';
    public $buku_id;
    public $nama_bab;
    public $sub_bab;
    public $materi;
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
    public function createBab()
    {
        BabBuku::query()->create([
            'buku_id'   => $this->buku_id,
            'nama_bab'  => $this->nama_bab,
            'sub_bab'   => $this->sub_bab,
            'materi'    => $this->materi
        ]);
        session()->flash('succes', 'Bab Buku Telah Berhasil Di Tambahakan');
    }
    public function render()
    {
        $bab = $this->getBabByIdBuku();
        $buku = $this->getBukuById();
        return view('livewire.guru.bab-buku.list-bab-buku', [
            'bab' => $bab,
            'buku' => $buku
        ]);
    }
    public function deleted($idBuku)
    {
        $babBuku = BabBuku::query()->where('buku_id', $idBuku);
        if ($babBuku !== null) {
            $babBuku->delete();
        }
        $buku = Buku::query()->where('id', $idBuku);
        $buku->delete();
        return redirect()->to('/guru/buku')->with('success', 'Buku Berhasil Di Hapus!!');
    }
    public function deleteSubBab($idSubBab)
    {
        $babBuku = BabBuku::query()->find($idSubBab);
        $babBuku->delete();
        session()->flash('succes', 'Sub Bab Berhasil Di Hapus');
    }
    public function showBabBuku($idSubBab)
    {
        $babBuku = BabBuku::query()->find($idSubBab);
        $this->nama_bab = $babBuku->nama_bab;
        $this->sub_bab = $babBuku->sub_bab;
        $this->materi = $babBuku->materi;
    }
    public function clearRequest()
    {
        $this->nama_bab = null;
        $this->sub_bab = null;
        $this->materi = null;
    }
    public function upadteBabBuku($idBAb)
    {
        $babBuku = BabBuku::query()->find($idBAb);
        $babBuku->update([
            'nama_bab' => $this->nama_bab,
            'sub_bab' => $this->sub_bab,
            'materi'    => $this->materi
        ]);
        session()->flash('succes', 'Bab Berhasil Di Update!!');
    }
}
