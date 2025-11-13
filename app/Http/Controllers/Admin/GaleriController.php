<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with(['creator', 'updater'])
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        foreach ($request->file('gambar') as $file) {
            $path = $file->store('galeri', 'public');
            Galeri::create([
                'gambar_path' => $path,
                'caption' => $request->caption,
                'created_by' => Auth::id(),
                'is_active' => true,
            ]);
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', translateText('Galeri berhasil ditambahkan!'));
    }

    // === EDIT ===
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    // === UPDATE ===
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $data = [
            'caption' => $request->caption,
            'updated_by' => Auth::id(),
        ];

        // Jika ada gambar baru → hapus lama, upload baru
        if ($request->hasFile('gambar')) {
            if ($galeri->gambar_path) {
                Storage::disk('public')->delete($galeri->gambar_path);
            }
            $data['gambar_path'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', translateText('Galeri berhasil diperbarui!'));
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar_path) {
            Storage::disk('public')->delete($galeri->gambar_path);
        }
        $galeri->update(['is_active' => false, 'updated_by' => Auth::id()]);

        return back()->with('success', translateText('Gambar dihapus!'));
    }
}