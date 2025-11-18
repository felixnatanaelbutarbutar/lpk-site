{{-- resources/views/admin/profile/edit.blade.php --}}
@extends('layouts.admin.layout')
@section('page-title', translateText('Edit Profil LKP'))

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">{{ translateText('Edit Profil LKP') }}</h1>

    @if(session('success'))
        <div class="mb-6 p-5 bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-300 text-emerald-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf @method('PATCH')

        <!-- Logo -->
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <label class="block font-semibold mb-3">{{ translateText('Logo LKP') }}</label>
                @if($profile->logo_path)
                    <img src="{{ asset('storage/'.$profile->logo_path) }}" class="w-48 h-48 object-contain rounded-lg shadow mb-3">
                @endif
                <input type="file" name="logo" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
            </div>
        </div>

        <!-- Informasi Utama -->
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-2">{{ translateText('Nama LKP') }} <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $profile->nama) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
            </div>
            <div>
                <label class="block font-medium mb-2">{{ translateText('Nama Direktur') }}</label>
                <input type="text" name="direktur" value="{{ old('direktur', $profile->direktur) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
            </div>
            <div>
                <label class="block font-medium mb-2">{{ translateText('Website') }}</label>
                <input type="url" name="website" value="{{ old('website', $profile->website) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
            </div>
            <div>
                <label class="block font-medium mb-2">{{ translateText('NPWP') }}</label>
                <input type="text" name="npwp" value="{{ old('npwp', $profile->npwp) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
            </div>
        </div>

        <div>
            <label class="block font-medium mb-2">{{ translateText('Alamat Lengkap') }}</label>
            <textarea name="alamat" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">{{ old('alamat', $profile->alamat) }}</textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-2">{{ translateText('Visi') }}</label>
                <textarea name="visi" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">{{ old('visi', $profile->visi) }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-2">{{ translateText('Misi') }}</label>
                <textarea name="misi" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">{{ old('misi', $profile->misi) }}</textarea>
            </div>
        </div>

        <div>
            <label class="block font-medium mb-2">{{ translateText('Sejarah LKP') }}</label>
            <textarea name="sejarah" rows="8" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">{{ old('sejarah', $profile->sejarah) }}</textarea>
        </div>

        <!-- Perizinan -->
        <div class="bg-gray-50 dark:bg-zinc-800 p-8 rounded-xl">
            <h3 class="text-2xl font-bold mb-6">{{ translateText('Data Perizinan & Legalitas') }}</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Tanggal Pendirian') }}</label>
                    <input type="date" name="tanggal_pendirian"
                           value="{{ old('tanggal_pendirian', is_string($profile->tanggal_pendirian) ? $profile->tanggal_pendirian : ($profile->tanggal_pendirian?->format('Y-m-d') ?? '')) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                    @error('tanggal_pendirian')
                        <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Nomor SK Pendirian') }}</label>
                    <input type="text" name="sk" value="{{ old('sk', $profile->sk) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Akta Perubahan') }}</label>
                    <input type="text" name="akta_perubahan" value="{{ old('akta_perubahan', $profile->akta_perubahan) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('NIB / Perizinan Berusaha') }}</label>
                    <input type="text" name="perizinan_berusaha" value="{{ old('perizinan_berusaha', $profile->perizinan_berusaha) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Izin Dinas Sosial') }}</label>
                    <input type="text" name="izin_dinas_sosial" value="{{ old('izin_dinas_sosial', $profile->izin_dinas_sosial) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Izin Dinas Ketenagakerjaan') }}</label>
                    <input type="text" name="izin_dinas_ketenagakerjaan" value="{{ old('izin_dinas_ketenagakerjaan', $profile->izin_dinas_ketenagakerjaan) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Registrasi Kemnaker') }}</label>
                    <input type="text" name="kementrian_ketenagakerjaan" value="{{ old('kementrian_ketenagakerjaan', $profile->kementrian_ketenagakerjaan) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
                <div>
                    <label class="block font-medium mb-2">{{ translateText('Akreditasi (A/B/C)') }}</label>
                    <input type="text" name="akreditasi" value="{{ old('akreditasi', $profile->akreditasi) }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-zinc-700">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.profile.index') }}" class="px-8 py-3 border rounded-lg font-medium">
                {{ translateText('Batal') }}
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow hover:shadow-xl transition">
                {{ translateText('Simpan Perubahan') }}
            </button>
        </div>
    </form>
</div>
@endsection