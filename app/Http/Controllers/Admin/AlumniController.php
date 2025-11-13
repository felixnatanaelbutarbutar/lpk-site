<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::with(['creator', 'updater'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nama' => 'required|string|max:255',
            'program' => 'required|in:GINOU JISSHUUSEI,TOKUTEI GINOU (MANDIRI)',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'pesan' => 'nullable|string',
        ]);

        $data = $request->only(['nama', 'program', 'tahun_lulus', 'pesan']);
        $data['created_by'] = Auth::id();
        $data['is_active'] = true;

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('alumni', 'public');
        }

        Alumni::create($data);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', translateText('Alumni berhasil ditambahkan!'));
    }

    public function edit(Alumni $alumni)
    {
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nama' => 'required|string|max:255',
            'program' => 'required|in:GINOU JISSHUUSEI,TOKUTEI GINOU (MANDIRI)',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'pesan' => 'nullable|string',
        ]);

        $data = $request->only(['nama', 'program', 'tahun_lulus', 'pesan']);
        $data['updated_by'] = Auth::id();

        if ($request->hasFile('foto')) {
            if ($alumni->foto_path) {
                Storage::disk('public')->delete($alumni->foto_path);
            }
            $data['foto_path'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumni->update($data);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', translateText('Alumni berhasil diperbarui!'));
    }

    public function destroy(Alumni $alumni)
    {
        if ($alumni->foto_path) {
            Storage::disk('public')->delete($alumni->foto_path);
        }
        $alumni->update(['is_active' => false, 'updated_by' => Auth::id()]);

        return back()->with('success', translateText('Alumni dihapus!'));
    }
}