<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EskulController;
use App\Http\Controllers\Api\MapelController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\DaftarKelasController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/**
 * Api Register
 */
Route::post('/register', [RegisterController::class, 'register']);

/**
 * Api Login
 */
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('eskul', EskulController::class);
    Route::resource('daftar', DaftarKelasController::class);
    Route::resource('mapel', MapelController::class);
});
