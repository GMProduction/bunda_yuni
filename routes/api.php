<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('barangs', [\App\Http\Controllers\API\BarangController::class, 'index']);
    Route::prefix('cart')->group(function () {
        Route::match(['POST', 'GET'], '', [\App\Http\Controllers\API\KeranjangController::class, 'index']);
        Route::post('checkout', [\App\Http\Controllers\API\KeranjangController::class, 'checkout']);
    });
    Route::prefix('transaction')->group(function () {
        Route::get('', [\App\Http\Controllers\API\TransaksiController::class, 'index']);
        Route::get('{id}', [\App\Http\Controllers\API\TransaksiController::class, 'detail']);
        Route::post('{id}/terima', [\App\Http\Controllers\API\TransaksiController::class, 'terima']);
        Route::post('{id}/upload-image', [\App\Http\Controllers\API\TransaksiController::class, 'uploadImg']);

    });
    Route::prefix('profile')->group(function (){
        Route::match(['POST','GET'],'',[\App\Http\Controllers\API\ProfileController::class, 'index']);
    });
//    Route::match(['POST', 'GET'], 'absen', [\App\Http\Controllers\API\AbsensiController::class, 'index']);
});

Route::post('login', [\App\Http\Controllers\API\LoginController::class, 'login']);
Route::post('register', [\App\Http\Controllers\API\LoginController::class, 'register']);
