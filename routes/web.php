<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategorisasiController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('layouts.main');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PerusahaanController::class, 'index']);
    Route::get('/perusahaan', [PerusahaanController::class, 'index']);
    Route::get('/cetak', [PerusahaanController::class, 'cetak']);
    Route::get('/perusahaan/{id}', [PerusahaanController::class, 'detail'])->name('perusahaan.detail');
    Route::get('/perusahaan/{id}/pelanggaran', [PerusahaanController::class, 'pelanggaran'])->name('perusahaan.pelanggaran');
    
    Route::get('/catat/{id}', [CatatanController::class, 'index'])->name('catat');
    Route::get('/catat/getpelanggaran/{id}', [PelanggaranController::class, 'getPelanggaran'])->name('catat');
    Route::post('/catat/{id}', [CatatanController::class, 'store'])->name('catat');
    Route::get('/catat/{id}/edit', [CatatanController::class, 'halamanEditCatatan']);
    Route::post('/catat/{id}/edit', [CatatanController::class, 'editCatatan']);
    Route::get('/catat/{id}/delete', [CatatanController::class, 'delete']);
    Route::post('/catat/{id}/cetak', [CatatanController::class, 'cetakLaporan']);
    Route::post('/ubahPassword/commit', [UserController::class, 'ubahPassword'])->name('user.ubahPassword');    
    Route::get('/ubahPassword', [UserController::class, 'halamanUbahPassword'])->name('user.ubahPassword');
    
    Route::get('/kategorisasi/{id}', [KategorisasiController::class, 'index'])->name('kategorisasi');
    Route::get('/kategorisasi/{id_trader}/submit', [KategorisasiController::class, 'submit'])->name('SubmitKategorisasi');

    Route::get('/bobot/{id}', [BobotController::class, 'index'])->name('bobot');
    Route::get('/bobot/{id_trader}/submit', [BobotController::class, 'submit'])->name('SubmitBobot');
});
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware(['admin'])->group(function () {
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran');
    Route::get('/pelanggaran/edit/{id}', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
    Route::post('/pelanggaran/edit/{id}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
    Route::get('/pelanggaran/tambah', [PelanggaranController::class, 'tambah'])->name('pelanggaran.tambah');
    Route::post('/pelanggaran/tambah', [PelanggaranController::class, 'insert'])->name('pelanggaran.tambah ');
    Route::get('/pelanggaran/hapus/{id}', [PelanggaranController::class, 'delete']);
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');    
    Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('admin.user.hapus');    
    Route::post('/user/edit', [UserController::class, 'edit'])->name('admin.user.edit');    
});




// Route::post('/storepelanggaran/{id}', [PelanggaranController::class, 'store'])->name('store.pelanggaran');
// Route::get('/ppelanggaran/{id}', [PelanggaranController::class, 'index']);
// Route::get('/pelanggarann/{id}', [PelanggaranController::class, 'input']);
// Route::get('/editcatatan/{id}', [PelanggaranController::class, 'halamanEditCatatan']);
// Route::post('/editcatatan/{id}', [PelanggaranController::class, 'editCatatan']);



Route::post('/cetakpelanggaran/{id}', [PerusahaanController::class, 'cetakPdf'])->name('pelanggaran.cetakPdf');
Route::get('/pelanggaran/kategoripelanggaran/{id}', [PelanggaranController::class, 'kriteria']);
Route::get('/pelanggaran/kriteriapelanggaran/{kriteria}', [PelanggaranController::class, 'kriteriaPelanggaran']);
Route::get('/pelanggaran/deskripsipelanggaran/{id}', [PelanggaranController::class, 'deskripsiPelanggaran']);
