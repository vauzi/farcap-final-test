<?php

namespace App\Http\Livewire\Guru\Buku;

use App\Models\AksesBuku;
use App\Models\Buku;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IzinAkses extends Component
{
    public $userId;

    public $bukuById;

    public $getSiswa;

    public $aksesSiswa;

    public $judulBuku;
    public $siswa;
    public function serchBuku()
    {
        $this->userId = Auth::user()->id;
        $buku = Buku::query()
            ->where('judul', 'LIKE', '%' . $this->judulBuku . '%')
            ->where('user_id', $this->userId)
            ->join('kelas', 'kelas.id', '=', 'bukus.kelas_id',)
            ->select('bukus.*',)
            ->groupBy('bukus.id')
            ->get();
        return $buku;
    }
    public function getAllSiswa()
    {
        $this->getSiswa = Profile::query()
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('siswa_kelas', 'siswa_kelas.user_id', '=', 'users.id')
            ->join('kelas', 'kelas.id', '=', 'siswa_kelas.kelas_id')
            ->select('profiles.*', 'kelas.kelas as kelases')
            ->where('users.role_id', 3)
            ->get();
        $this->getAkses($this->bukuById->id);
    }
    public function getBukuById($id)
    {
        $this->bukuById = Buku::query()->find($id);
        $this->getAkses($this->bukuById->id);
        // dd($this->aksesSiswa->id);
    }
    public function render()
    {
        $buku = $this->serchBuku();
        return view('livewire.guru.buku.izin-akses', [
            'buku' => $buku
        ]);
    }
    public function createAkses($idUser)
    {
        $data = AksesBuku::query()
            ->where('user_id', $idUser)
            ->where('buku_id', $this->bukuById->id)
            ->first();
        if ($data !== null) {
            $this->getBukuById($this->bukuById->id);
            $this->getAllSiswa();
        } else {
            $akses = AksesBuku::query()->create([
                'user_id' => $idUser,
                'buku_id' => $this->bukuById->id
            ]);
            $this->getBukuById($akses->buku_id);
            $this->getAllSiswa();
        }
    }
    public function getAkses($id)
    {
        $this->aksesSiswa = AksesBuku::query()
            ->where('buku_id', $id)
            ->join('profiles', 'profiles.user_id', '=', 'akses_bukus.user_id')
            ->join('siswa_kelas', 'siswa_kelas.user_id', '=', 'profiles.user_id')
            ->join('kelas', 'kelas.id', '=', 'siswa_kelas.kelas_id')
            ->select('profiles.*', 'kelas.*', 'akses_bukus.id as akses_id')
            ->get();
    }
    public function deleteAkses($id)
    {
        $akses = AksesBuku::query()->find($id);
        $this->getAkses($akses->id);
        $akses->delete();
        $this->getAkses($akses->buku_id);
    }
}
