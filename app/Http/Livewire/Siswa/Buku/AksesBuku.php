<?php

namespace App\Http\Livewire\Siswa\Buku;

use App\Models\AksesBuku as ModelsAksesBuku;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AksesBuku extends Component
{

    public function render()
    {
        // ->where('user_id', $userId)
        $userId = Auth::user()->id;
        $akses = ModelsAksesBuku::query()
            ->select('bukus.*', 'kelas.kelas', 'bukus.id as buku_id', 'profiles.nama as pengarang', 'profiles.foto as foto_pengarang', 'roles.role as jabatan')
            ->join('bukus', 'bukus.id', '=', 'akses_bukus.buku_id',)
            ->join('profiles', 'profiles.user_id', '=', 'bukus.user_id')
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->join('kelas', 'kelas.id', '=', 'bukus.kelas_id')
            ->where('akses_bukus.user_id', $userId)
            ->where('active', true)
            ->get();
        return view('livewire.siswa.buku.akses-buku', ['buku' => $akses]);
    }
}
