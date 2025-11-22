<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Cache::remember('profile_data', now()->addHours(6), function () {
            return Profile::with(['creator', 'updater'])->first();
        });

        // Kalau belum ada data sama sekali
        if (!$profile) {
            abort(404, 'Profil lembaga belum tersedia.');
        }

        return view('profile', compact('profile'));
    }
}