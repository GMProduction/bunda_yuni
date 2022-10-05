<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterPelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(
    function () {
        Route::match(['POST', 'GET'], '', [UserController::class, 'index']);
        Route::prefix('barang')->group(
            function () {
                Route::match(['POST', 'GET'], '', [BarangController::class, 'index']);
            }
        );
        Route::prefix('laporan')->group(
            function () {
                Route::get('', [LaporanController::class, 'index']);
                Route::get('{id}', [LaporanController::class, 'detail']);
            }
        );
        Route::get('cetak', [TransaksiController::class, 'cetakLaporan']);
        Route::get('transaksi', [TransaksiController::class, 'index']);

    }
);

Route::match(['POST','GET'],'/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->middleware('auth');
