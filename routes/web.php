<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\PasienController;

//login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Semua route CRUD dilindungi middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('rumah-sakit.index');
    });
    // CRUD Rumah Sakit dan Pasien
    Route::resource('rumah-sakit', RumahSakitController::class);
    Route::resource('pasiens', PasienController::class)->except(['show']);

    // ajax filter pasien
    Route::get('/pasiens/filter', [PasienController::class, 'filter'])
        ->name('pasiens.filter');
});
