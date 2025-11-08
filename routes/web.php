<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranSiswaController;

Route::middleware(['set.locale'])->group(function () {
    // 🌐 Halaman publik
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // 🧭 Dashboard umum (user biasa)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::user();

            // Arahkan otomatis berdasarkan role
            if ($user && $user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            if ($user && $user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }

            // Default fallback
            return redirect()->route('home');
        })->name('dashboard');

        // 👤 Profil pengguna
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    });
    // routes/web.php
Route::middleware(['auth', 'set.locale'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranSiswaController::class, 'index'])
        ->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranSiswaController::class, 'create'])
        ->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranSiswaController::class, 'store'])
        ->name('pendaftaran.store');
        // DETAIL
    Route::get('/pendaftaran/{pendaftaran}', [PendaftaranSiswaController::class, 'show'])
    ->name('pendaftaran.show');
});

    // 🌍 Ganti bahasa (ID, EN, JP)
    Route::get('/lang/{locale}', function ($locale) {
        $available = ['id', 'en', 'jp'];
        if (in_array($locale, $available)) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    })->name('lang.switch');

    // 🛠️ Grup route admin
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    });

    // 🧑‍💼 Grup route user
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard'); // Pastikan ada file resources/views/user/dashboard.blade.php
        })->name('dashboard');
    });

    Route::middleware(['auth', 'role:admin', 'set.locale'])
        ->prefix('admin')->name('admin.')
        ->group(function () {
            Route::view('/', 'admin.dashboard')->name('dashboard');
            Route::resource('registrations', Admin\RegistrationController::class)->only(['index', 'show', 'update']);
            Route::resource('facilities', Admin\FacilityController::class);
            Route::resource('gallery', Admin\GalleryController::class);
            Route::resource('alumni', Admin\AlumniController::class);
            Route::resource('programs', Admin\ProgramController::class);
            Route::resource('users', Admin\UserController::class)->only(['index', 'update']);
            Route::view('settings', 'admin.settings.index')->name('settings.index');
        });


    // 🔐 Route bawaan Breeze (login, register, forgot password, dll)
    require __DIR__ . '/auth.php';
});

