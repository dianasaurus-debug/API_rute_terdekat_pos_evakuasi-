<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SopController;
use App\Http\Controllers\BpbdController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LabenController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;

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
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('kecamatan')->group(function () {
        Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan.index');
        Route::get('/tambah', [KecamatanController::class, 'create'])->name('kecamatan.create');
        Route::post('/tambah', [KecamatanController::class, 'store'])->name('kecamatan.store');
        Route::get('/{kecamatan}/edit', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
        Route::put('/{kecamatan}/update', [KecamatanController::class, 'update'])->name('kecamatan.update');
        Route::delete('/{kecamatan}/delete', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');
    });

    Route::prefix('desa')->group(function () {
        Route::get('/', [DesaController::class, 'index'])->name('desa.index');
        Route::get('/tambah', [DesaController::class, 'create'])->name('desa.create');
        Route::post('/tambah', [DesaController::class, 'store'])->name('desa.store');
        Route::get('/{desa}/edit', [DesaController::class, 'edit'])->name('desa.edit');
        Route::put('/{desa}/update', [DesaController::class, 'update'])->name('desa.update');
        Route::delete('/{desa}/delete', [DesaController::class, 'destroy'])->name('desa.destroy');
    });

    Route::prefix('posko-evakuasi')->group(function () {
        Route::get('/', [PoskoController::class, 'index'])->name('posko.index');
        Route::get('/tambah', [PoskoController::class, 'create'])->name('posko.create');
        Route::post('/tambah', [PoskoController::class, 'store'])->name('posko.store');
        Route::get('/{posevakuasi}/edit', [PoskoController::class, 'edit'])->name('posko.edit');
        Route::put('/{posevakuasi}/update', [PoskoController::class, 'update'])->name('posko.update');
        Route::delete('/{posevakuasi}/delete', [PoskoController::class, 'destroy'])->name('posko.destroy');
    });

    Route::prefix('riwayat')->group(function () {
        Route::get('/{bencana}', [RiwayatController::class, 'index'])->name('riwayat.index');
        Route::get('/{bencana}/tambah', [RiwayatController::class, 'create'])->name('riwayat.create');
        Route::post('/{bencana}/tambah', [RiwayatController::class, 'store'])->name('riwayat.store');
        Route::get('/{bencana}/{riwayatbencana}/edit', [RiwayatController::class, 'edit'])->name('riwayat.edit');
        Route::put('/{bencana}/{riwayatbencana}/update', [RiwayatController::class, 'update'])->name('riwayat.update');
        Route::delete('/{bencana}/{riwayatbencana}/delete', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
    });

    Route::get('/sop/{bencana}', SopController::class)->name('sop.index');

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/tambah', [UserController::class, 'create'])->name('user.create');
        Route::post('/tambah', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{user}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('bpbd')->group(function () {
        Route::get('/', [BpbdController::class, 'index'])->name('bpbd.index');
        Route::get('/tambah', [BpbdController::class, 'create'])->name('bpbd.create');
        Route::post('/tambah', [BpbdController::class, 'store'])->name('bpbd.store');
        Route::get('/{bpbd}/edit', [BpbdController::class, 'edit'])->name('bpbd.edit');
        Route::put('/{bpbd}/update', [BpbdController::class, 'update'])->name('bpbd.update');
        Route::delete('/{bpbd}/delete', [BpbdController::class, 'destroy'])->name('bpbd.destroy');
    });

    Route::prefix('laporan-bencana')->group(function () {
        Route::get('/', [LabenController::class, 'index'])->name('laben.index');
        Route::get('/{laporanbencana}/edit', [LabenController::class, 'edit'])->name('laben.edit');
        Route::put('/{laporanbencana}/update', [LabenController::class, 'update'])->name('laben.update');
        Route::delete('/{laporanbencana}/delete', [LabenController::class, 'destroy'])->name('laben.destroy');
    });
});

require __DIR__.'/auth.php';
