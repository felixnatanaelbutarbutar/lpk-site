<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranSiswaController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==================================================================
// 1. HALAMAN PUBLIK (tanpa auth)
// ==================================================================
Route::middleware(['set.locale'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Ganti bahasa: /lang/id, /lang/en, /lang/ja
    Route::get('/lang/{locale}', function ($locale) {
        $available = ['id', 'en', 'ja'];
        if (in_array($locale, $available)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back();
    })->name('lang.switch');
});

// ==================================================================
// 2. DASHBOARD OTOMATIS BERDASARKAN ROLE
// ==================================================================
Route::middleware(['auth', 'set.locale'])->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user?->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================================================================
// 3. USER ROUTES (PENDAFTARAN)
// ==================================================================
Route::middleware(['auth', 'set.locale'])->prefix('pendaftaran')->name('pendaftaran.')->group(function () {

    Route::get('/', [PendaftaranSiswaController::class, 'index'])->name('index');
    Route::get('/create', [PendaftaranSiswaController::class, 'create'])->name('create');
    Route::post('/', [PendaftaranSiswaController::class, 'store'])->name('store');
    Route::get('/{pendaftaran}', [PendaftaranSiswaController::class, 'show'])->name('show');
    Route::get('/{pendaftaran}/edit', [PendaftaranSiswaController::class, 'edit'])->name('edit');
    Route::put('/{pendaftaran}', [PendaftaranSiswaController::class, 'update'])->name('update');
    Route::delete('/{pendaftaran}', [PendaftaranSiswaController::class, 'destroy'])->name('destroy');
});

// ==================================================================
// 4. USER DASHBOARD
// ==================================================================
Route::middleware(['auth', 'set.locale'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
});

// ==================================================================
// 5. ADMIN ROUTES (HANYA UNTUK is_admin = 1)
// ==================================================================
Route::middleware(['auth', 'admin', 'set.locale'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {

         // Dashboard Admin
         Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

         // Pendaftaran: lihat semua + approve/reject
         Route::get('/pendaftaran', [PendaftaranAdminController::class, 'index'])
              ->name('pendaftaran.index');

         Route::patch('/pendaftaran/{pendaftaran}/approve', [PendaftaranAdminController::class, 'approve'])
              ->name('pendaftaran.approve');

         Route::patch('/pendaftaran/{pendaftaran}/reject', [PendaftaranAdminController::class, 'reject'])
              ->name('pendaftaran.reject');

         // === FITUR ADMIN LAIN (jika ada) ===
         // Route::resource('registrations', Admin\RegistrationController::class)->only(['index', 'show', 'update']);
         // Route::resource('users', Admin\UserController::class)->only(['index', 'update']);
         // Route::view('settings', 'admin.settings.index')->name('settings.index');
     });

// ==================================================================
// 6. AUTH ROUTES (Breeze)
// ==================================================================
require __DIR__ . '/auth.php';