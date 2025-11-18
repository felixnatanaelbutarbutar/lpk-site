<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::with(['creator', 'updater'])->firstOrFail();
        return view('admin.profile.index', compact('profile'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255|unique:profile,nama',
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'visi'     => 'nullable|string',
            'misi'     => 'nullable|string',
            'sejarah'  => 'nullable|string',
            'direktur' => 'nullable|string|max:255',
            'tanggal_pendirian' => 'nullable|date',
            'akta_perubahan'    => 'nullable|string',
            'sk'                => 'nullable|string',
            'izin_dinas_sosial' => 'nullable|string',
            'izin_dinas_ketenagakerjaan' => 'nullable|string',
            'perizinan_berusaha' => 'nullable|string',
            'akreditasi'        => 'nullable|string',
            'kementrian_ketenagakerjaan' => 'nullable|string',
            'npwp'      => 'nullable|string',
            'website'   => 'nullable|url:http,https',
            'alamat'    => 'nullable|string',
        ]);

        $data = $request->except('logo');
        $data['created_by'] = Auth::id();

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('profile', 'public');
        }

        Profile::create($data);

        Cache::forget('profile_data');

        return redirect()
            ->route('admin.profile.index')
            ->with('success', translateText('Profil berhasil dibuat!'));
    }

    public function edit()
    {
        $profile = Profile::firstOrFail();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrFail();

        $request->validate([
            'nama'     => 'required|string|max:255',
            'visi'     => 'nullable|string',
            'misi'     => 'nullable|string',
            'sejarah'  => 'nullable|string',
            'direktur' => 'nullable|string|max:255',
            'tanggal_pendirian' => 'nullable|date',
            'akta_perubahan'    => 'nullable|string',
            'sk'                => 'nullable|string',
            'izin_dinas_sosial' => 'nullable|string',
            'izin_dinas_ketenagakerjaan' => 'nullable|string',
            'perizinan_berusaha' => 'nullable|string',
            'akreditasi'        => 'nullable|string',
            'kementrian_ketenagakerjaan' => 'nullable|string',
            'npwp'      => 'nullable|string',
            'website'   => 'nullable|url:http,https',
            'alamat'    => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('logo');
        $data['updated_by'] = Auth::id();

        if ($request->hasFile('logo')) {
            if ($profile->logo_path) {
                Storage::disk('public')->delete($profile->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('profile', 'public');
        }

        $profile->update($data);

        Cache::forget('profile_data');

        return back()->with('success', translateText('Profil berhasil diperbarui!'));
    }

    public function removeLogo()
    {
        $profile = Profile::firstOrFail();

        if ($profile->logo_path) {
            Storage::disk('public')->delete($profile->logo_path);
            $profile->update(['logo_path' => null, 'updated_by' => Auth::id()]);
        }

        Cache::forget('profile_data');

        return response()->json(['success' => true]);
    }

    public function retranslate()
    {
        $profile = Profile::firstOrFail();
        $profile->touch(); // trigger saving → auto translate

        return back()->with('success', translateText('Terjemahan berhasil diperbarui!'));
    }

    public function preview()
    {
        $profile = Profile::firstOrFail();
        return view('public.tentang-kami', compact('profile'));
    }
}