<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RiwayatBencanaController;
use App\Http\Controllers\API\PosEvakuasiController;
use App\Http\Controllers\API\LaporanBencanaController;
use App\Http\Controllers\API\LaporanBantuanController;
use App\Http\Controllers\API\BPBDAccountController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'auth'], function(){
    Route::post('login', [UserController::class, 'login']);
    Route::post('signup', [UserController::class, 'signup']);
});
Route::group(['prefix' => 'bpbd-auth'], function(){
    Route::post('login', [BPBDAccountController::class, 'login']);
    Route::post('signup', [BPBDAccountController::class, 'signup']);
});
Route::group(['middleware' => ['auth:user-api','scopes:user']], function () {
    Route::get('profile', [UserController::class, 'user']);
    Route::get('/auth/logout', [UserController::class, 'logout']);
    Route::post('laporan-bencana', [LaporanBencanaController::class, 'store']);
    Route::post('laporan-bantuan', [LaporanBantuanController::class, 'store']);
});
Route::group(['prefix' => 'bpbd-auth', 'middleware' => ['auth:bpbd-api','scopes:bpbd']], function () {
    Route::get('profile', [BPBDAccountController::class, 'user']);
    Route::get('logout', [BPBDAccountController::class, 'logout']);
});
Route::group(['middleware' => ['auth:bpbd-api','scopes:bpbd']], function () {
    Route::put('laporan-bencana/validate/{id}', [LaporanBencanaController::class, 'validasi']);
    Route::put('laporan-bencana/reject/{id}', [LaporanBencanaController::class, 'reject']);
    Route::put('laporan-bantuan/validate/{id}', [LaporanBantuanController::class, 'validasi']);
    Route::put('laporan-bantuan/execute/{id}', [LaporanBantuanController::class, 'laksanakan']);
});

Route::get('riwayat-bencana', [RiwayatBencanaController::class, 'index']);
Route::get('posko-evakuasi', [PosEvakuasiController::class, 'index']);
Route::get('laporan-bencana', [LaporanBencanaController::class, 'index']);
Route::get('laporan-bantuan', [LaporanBantuanController::class, 'index']);

