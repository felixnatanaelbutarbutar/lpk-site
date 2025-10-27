<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (with locale middleware)
|--------------------------------------------------------------------------
| - Default language EN; user/admin bisa ganti via ?lang=en|id|ja
| - Email verification dihapus: hilangkan middleware 'verified'
| - auth routes (login/register/forgot) tetap di routes/auth.php
*/

Route::middleware(['set.locale'])->group(function () {
    // Halaman publik
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Dashboard (login required; TIDAK pakai 'verified' karena email_verified_at ditiadakan)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    // Area profil user (login required)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // (Opsional) Grup admin—aktifkan saat sudah ada dashboard admin
    Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');
        // Contoh route admin lain:
        // Route::resource('users', Admin\UserController::class);
        // Route::resource('registrations', Admin\RegistrationController::class);
    });

    // Auth routes (Breeze)
    require __DIR__ . '/auth.php';
});
