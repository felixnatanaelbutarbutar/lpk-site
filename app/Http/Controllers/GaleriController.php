<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Tampilkan halaman galeri publik
     */
    public function index()
    {
        // Hanya tampilkan yang aktif
        $galeri = Galeri::where('is_active', true)
            ->latest()
            ->get();

        return view('galeri', compact('galeri'));
    }

    /**
     * Tampilkan detail gambar
     */
    // public function show(Galeri $galeri)
    // {
    //     if (! $galeri->is_active) {
    //         abort(404);
    //     }

    //     return view('galeri.show', compact('galeri'));
    // }
}

