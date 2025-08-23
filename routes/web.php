<?php

use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PermintaanController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::resource('ruang', RuangController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ])->middleware('userAkses:admin');
    Route::get('/ruang/{slug}', [RuangController::class, 'show'])->name('ruang.show');
    Route::delete('/ruang/{id}', 'RuangController@destroy')->name('ruang.destroy');
    Route::get('print/{slug}', [RuangController::class, 'print'])->name('ruang.print');

    Route::resource('pengguna', PenggunaController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ])->middleware('userAkses:admin');

    Route::resource('kategori', KategoriController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ])->middleware('userAkses:admin');
    Route::delete('/kategori/{id}', 'KategoriController@destroy')->name('kategori.destroy');

    Route::resource('jurusan', JurusanController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ])->middleware('userAkses:admin');
    Route::delete('/jurusan/{id}', 'JurusanController@destroy')->name('jurusan.destroy');

    Route::resource('kondisi', KondisiController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ])->middleware('userAkses:admin');
    Route::delete('/kondisi/{id}', 'KondisiController@destroy')->name('kondisi.destroy');

    Route::resource('peminjaman', PeminjamanController::class)->only([
        'index',
        'store',
        'update'
    ]);
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::put('/peminjaman/approve/{id}', [PeminjamanController::class, 'approve']);
    Route::get('/laporan-peminjaman-barang', [PeminjamanController::class, 'laporanPeminjaman'])->name('peminjaman.report');

    Route::resource('permintaan', PermintaanController::class)->only([
        'index',
        'store',
        'update'
    ]);
    Route::delete('/permintaan/{id}', [PermintaanController::class, 'destroy'])->name('permintaan.destroy');
    Route::post('/permintaan/{id}/reject', [PermintaanController::class, 'reject'])->name('permintaan.reject');
    Route::get('permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/laporan-permintaan-barang', [PermintaanController::class, 'laporanPermintaan'])->name('permintaan.report');


    Route::resource('barang-masuk', BarangMasukController::class)->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ])->middleware('userAkses:admin');
    Route::get('/laporan-barang-masuk', [BarangMasukController::class, 'laporanBarangMasuk'])->name('barangMasuk.report');
    Route::delete('/barang-masuk/{id}', 'BarangMasukController@destroy')->name('barang-masuk.destroy');
    Route::put('barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barangMasuk.update');

    Route::get('barang-masuk', [App\Http\Controllers\BarangMasukController::class, 'index'])->name('barangMasuk.index');





    Route::get('/logout', [SesiController::class, 'logout']);
});
