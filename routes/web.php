<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth; // ⬅️ tambahkan di paling atas file web.php

/*
|--------------------------------------------------------------------------
| Web Routes (with locale middleware)
|--------------------------------------------------------------------------
| - Default language EN; user/admin bisa ganti via ?lang=en|id|ja
| - Tidak menggunakan 'verified' karena verifikasi email tidak diaktifkan
| - Auth routes tetap di routes/auth.php (paket Breeze)
*/

Route::middleware(['set.locale'])->group(function () {
    // 🌐 Halaman publik
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // 🧭 Dashboard umum (user biasa)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            // Arahkan otomatis berdasarkan role
            $user = Auth::user(); // ⬅️ gunakan facade
            if ($user && $user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }
            return view('dashboard'); // tampilan user biasa
        })->name('dashboard');

        // 👤 Profil pengguna
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
        // Tambahkan route admin lain di sini nanti, misalnya:
        // Route::resource('programs', AdminProgramController::class);
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
