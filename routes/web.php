<?php

// use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Guru\BabBuku\ListBabBuku;
use App\Http\Livewire\Guru\Dashboard as GuruDashboard;
use App\Http\Livewire\Guru\Buku;
use App\Http\Livewire\Guru\Buku\Create as BukuCreate;
use App\Http\Livewire\Guru\Buku\IzinAkses;
use App\Http\Livewire\Siswa\Buku\AksesBuku;
use App\Http\Livewire\Siswa\Dashboard as SiswaDashboard;
use App\Http\Livewire\Siswa\ListBuku;
use App\Http\Livewire\Siswa\ShowBuku;
use App\Http\Livewire\TU\CreateUser;
use App\Http\Livewire\TU\Dashboard;
use App\Http\Livewire\TU\DetailUser;
use App\Http\Livewire\TU\ListSiswa;
use App\Http\Livewire\TU\UserList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('welcome');
});

//authentication routes group
// Route::prefix('auth/')->name('auth.')->group(function () {
//     Route::post('login', [LoginController::class, 'login'])->name('login');
//     Route::get('logout', [loginController::class, 'logout'])->name('logout');
// });

Route::get('/', Login::class)->name('login')->middleware('guest');
Route::get('/logout', [Login::class, 'logout'])->middleware(['auth']);

// start route TU (tata usaha)
Route::get('/tu/dashboard', Dashboard::class)->middleware(['auth', 'isTU']);

Route::get('/tu/list', UserList::class)->middleware(['auth', 'isTU']);
Route::get('/tu/user/create', CreateUser::class)->middleware(['auth', 'isTU']);
Route::get('/tu/list/siswa', ListSiswa::class)->middleware(['auth', 'isTU']);
// end route TU (tata usaha)

// start route Guru
Route::get('/guru/dashboard', GuruDashboard::class)->middleware(['auth', 'isGuru']);
Route::get('/guru/buku', Buku::class)->middleware(['auth', 'isGuru']);
Route::get('/guru/buku/create', BukuCreate::class)->middleware(['auth', 'isGuru']);
Route::get('/guru/bab-buku/{buku_id}', ListBabBuku::class)->name('guru.bab-buku')->middleware(['auth', 'isGuru']);
Route::get('/guru/buku/izin-akses', IzinAkses::class)->middleware(['auth', 'isGuru']);;
// End route Guru

// start route Siswa
Route::get('/siswa/dashboard', SiswaDashboard::class)->middleware(['auth']);
Route::get('/siswa/list/buku', ListBuku::class)->middleware(['auth']);
Route::get('/siswa/bab-buku/{buku_id}', ShowBuku::class)->name('siswa.bab-buku')->middleware(['auth']);
Route::get('/siswa/akses-buku', AksesBuku::class)->middleware(['auth']);
// end route Siswa