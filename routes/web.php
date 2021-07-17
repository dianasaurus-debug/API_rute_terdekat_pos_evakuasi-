<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\PoskoController;
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
    return view('welcome');
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
});

require __DIR__.'/auth.php';
