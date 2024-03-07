<?php

use App\Models\Siswa;
use Maatwebsite\Excel;
use GuzzleHttp\Middleware;
use App\Models\Presensi_siswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaImportController;
use App\Http\Controllers\PresensiSiswaController;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');
Route::get('/', [Controller::class, 'dashboard'])->middleware('auth');


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profil');
});

Route::get('/profil', [Controller::class, 'profil']);


// Route::get('/', function () {
//     return redirect('/dashboard');
// });



// Route::get('/laporan', function () {
//     return view('laporan.laporan');
// });

Route::get('/filter-laporan', [LaporanController::class, 'filterByDate'])->name('filter.laporan');


// userLogin
Route::get('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);
//userRegister
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::post('/register', [LoginController::class, 'registration']);

//userLogout
Route::post('/logout', [LoginController::class, 'logout']);

//Guru
Route::resource('/guru', GuruController::class)->middleware('auth');
//siswa
Route::resource('/siswa', SiswaController::class)->Middleware('auth');
//mapel
Route::resource('/mapel', MapelController::class)->middleware('admin');
//kelas
Route::resource('/kelas', KelasController::class)->middleware('auth');
//presensi
Route::resource('/presensi', PresensiController::class)->middleware('guru');
//presensi_siswa
Route::resource('/presensi_siswa/{kelas}/check', PresensiSiswaController::class);

Route::post('/filter-laporan', [LaporanController::class, 'filterByDate'])->name('filter.laporan');
Route::get('/laporan', [LaporanController::class, 'index'])->middleware('auth')->name('laporan.index');


Route::post('/siswa/import', [SiswaController::class, 'import']);

Route::post('/guru/import', [GuruController::class, 'file']);