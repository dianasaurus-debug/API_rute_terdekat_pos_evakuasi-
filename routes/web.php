<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
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
});

require __DIR__.'/auth.php';
