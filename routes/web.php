<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\PendaftaranSiswaController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\GaleriController as PublicGaleriController;
use App\Http\Controllers\AlumniPublicController;


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

// PUBLIC: Galeri halaman publik (pakai controller publik)
Route::get('/galeri', [PublicGaleriController::class, 'index'])->name('galeri.index');
// Route::get('/galeri/{galeri}', [PublicGaleriController::class, 'show'])->name('galeri.show');
Route::get('/', [AlumniPublicController::class, 'home'])->name('home');
Route::get('/alumni', [AlumniPublicController::class, 'index'])->name('alumni');

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
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
        // Routes unutk fasilitas..      
// PAKSA MANUAL → {fasilitas}
        Route::get('fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
        Route::get('fasilitas/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
        Route::post('fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
        Route::get('fasilitas/{fasilitas}', [FasilitasController::class, 'show'])->name('fasilitas.show');
        Route::get('fasilitas/{fasilitas}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
        Route::put('fasilitas/{fasilitas}', [FasilitasController::class, 'update'])->name('fasilitas.update');
        Route::delete('fasilitas/{fasilitas}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

         // === FITUR ADMIN LAIN (jika ada) ===
         Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
        Route::get('galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
        Route::post('galeri', [GaleriController::class, 'store'])->name('galeri.store');
        Route::get('galeri/{galeri}', [GaleriController::class, 'show'])->name('galeri.show');
        Route::get('galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
        Route::put('galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
        Route::delete('galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
         // Route::resource('registrations', Admin\RegistrationController::class)->only(['index', 'show', 'update']);
         Route::get('alumni', [AlumniController::class, 'index'])->name('alumni.index');
        Route::get('alumni/create', [AlumniController::class, 'create'])->name('alumni.create');
        Route::post('alumni', [AlumniController::class, 'store'])->name('alumni.store');
        Route::get('alumni/{alumni}', [AlumniController::class, 'show'])->name('alumni.show');
        Route::get('alumni/{alumni}/edit', [AlumniController::class, 'edit'])->name('alumni.edit');
        Route::put('alumni/{alumni}', [AlumniController::class, 'update'])->name('alumni.update');
        Route::delete('alumni/{alumni}', [AlumniController::class, 'destroy'])->name('alumni.destroy');
         // Route::resource('users', Admin\UserController::class)->only(['index', 'update']);
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/logo', [ProfileController::class, 'removeLogo'])->name('profile.remove-logo');
         // Route::view('settings', 'admin.settings.index')->name('settings.index');
     });

// ==================================================================
// 6. AUTH ROUTES (Breeze)
// ==================================================================
require __DIR__ . '/auth.php';