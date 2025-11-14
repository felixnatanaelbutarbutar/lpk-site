<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniPublicController extends Controller
{
    /**
     * Data yang dipakai pada halaman welcome (tampilkan 3 testimonial terbaru)
     */
    public function home()
    {
        $alumni = Alumni::where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('alumni'));
    }

    /**
     * Halaman listing alumni publik (opsional)
     */
    public function index()
    {
        $alumni = Alumni::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('alumni', compact('alumni'));
    }
}
