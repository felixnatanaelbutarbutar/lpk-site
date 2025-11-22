<?php
// app/Http/Controllers/FasilitasPublicController.php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Support\Facades\Cache;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Cache::remember('fasilitas_public', now()->addHours(6), function () {
            return Fasilitas::where('is_active', true)
                ->latest()
                ->get();
        });

        return view('fasilitas', compact('fasilitas'));
    }
}