<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\LkhController;
use App\Http\Controllers\LaporanSuratController;
use App\Http\Controllers\DesaCantikController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view("pages.landing");
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/mahasiswa', [ MahasiswaController::class, "index_view" ])->name('mahasiswa');
    Route::get('/mahasiswa-detail/{id}', [ MahasiswaController::class, "detail" ])->name('mahasiswa.detail');
    Route::get('/absensi', [ AbsensiController::class, "index_view" ])->name('absensi');
    Route::get('/lkh', [ LkhController::class, "index_view" ])->name('lkh');
    Route::get('/laporan-surat', [ LaporanSuratController::class, "index_view" ])->name('laporan-surat');
    Route::get('/laporan-surat/statistik/{id}', [ LaporanSuratController::class, "statistik_detail" ])->name('laporan-surat-statistik-detail');
    Route::get('/desa-cantik', [ DesaCantikController::class, "index_view" ])->name('desa-cantik');
    Route::get('/desa-cantik/statistik/{id}', [ DesaCantikController::class, "statistik_detail" ])->name('laporan-surat-statistik-detail');
});
