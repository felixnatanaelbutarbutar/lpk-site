<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with(['creator', 'updater'])
            ->where('is_active', true)
            ->latest()
            ->paginate(10);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:1000',
    ]);

    $path = $request->file('gambar')->store('fasilitas', 'public');

    Fasilitas::create([
        'gambar_path' => $path,
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'created_by' => Auth::id(),
        'is_active' => true,
    ]);

    return redirect()
    ->route('admin.fasilitas.index', ['lang' => app()->getLocale()])
    ->with('success', translateText('Pendaftaran berhasil disimpan!'));
}

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
{
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:1000',
    ]);

    $path = $fasilitas->gambar_path;
    if ($request->hasFile('gambar')) {
        if ($path) Storage::disk('public')->delete($path);
        $path = $request->file('gambar')->store('fasilitas', 'public');
    }

    $fasilitas->update([
        'gambar_path' => $path,
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'updated_by' => Auth::id(),
    ]);

    return redirect()
    ->route('admin.fasilitas.index', ['lang' => app()->getLocale()])
    ->with('success', translateText('Pendaftaran berhasil disimpan!'));
}

    public function destroy(Fasilitas $fasilitas)
    {
        if ($fasilitas->gambar_path) {
            Storage::disk('public')->delete($fasilitas->gambar_path);
        }
        $fasilitas->update(['is_active' => false, 'updated_by' => Auth::id()]);

        return back()->with('success', translateText('Fasilitas dihapus!'));
    }

}