{{-- resources/views/admin/profile/create.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Buat Profil LKP Baru'))

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">{{ translateText('Buat Profil LKP Baru') }}</h1>

    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8 space-y-8">

        @csrf

        <!-- Logo -->
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <label class="block font-semibold mb-3">{{ translateText('Logo LKP') }}</label>
                <input type="file" name="logo" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
                <p class="mt-2 text-xs text-gray-500">{{ translateText('Maksimal 2MB, format JPG/PNG/WEBP') }}</p>
            </div>
        </div>

        <!-- Informasi Utama -->
        <div class="grid md:grid-cols-2 gap-6">
            <x-input name="nama" label="Nama LKP" required :value="old('nama')" />
            <x-input name="direktur" label="Nama Direktur" :value="old('direktur')" />
            <x-input name="website" label="Website" type="url" :value="old('website')" />
            <x-input name="npwp" label="NPWP" :value="old('npwp')" />
        </div>

        <x-textarea name="alamat" label="Alamat Lengkap" rows="3">
            {{ old('alamat') }}
        </x-textarea>

        <div class="grid md:grid-cols-2 gap-6">
            <x-textarea name="visi" label="Visi" rows="4">
                {{ old('visi') }}
            </x-textarea>
            <x-textarea name="misi" label="Misi" rows="4">
                {{ old('misi') }}
            </x-textarea>
        </div>

        <x-textarea name="sejarah" label="Sejarah LKP" rows="6">
            {{ old('sejarah') }}
        </x-textarea>

        <!-- Data Perizinan -->
        <div class="bg-gray-50 dark:bg-zinc-800 p-8 rounded-xl border">
            <h3 class="text-xl font-bold mb-6">{{ translateText('Data Perizinan & Legalitas') }}</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <x-input name="tanggal_pendirian" label="Tanggal Pendirian" type="date" :value="old('tanggal_pendirian')" />
                <x-input name="sk" label="Nomor SK Pendirian" :value="old('sk')" />
                <x-input name="akta_perubahan" label="Akta Perubahan" :value="old('akta_perubahan')" />
                <x-input name="perizinan_berusaha" label="NIB / OSS" :value="old('perizinan_berusaha')" />
                <x-input name="izin_dinas_sosial" label="Izin Dinas Sosial" :value="old('izin_dinas_sosial')" />
                <x-input name="izin_dinas_ketenagakerjaan" label="Izin Dinas Ketenagakerjaan" :value="old('izin_dinas_ketenagakerjaan')" />
                <x-input name="kementrian_ketenagakerjaan" label="Registrasi Kemnaker" :value="old('kementrian_ketenagakerjaan')" />
                <x-input name="akreditasi" label="Akreditasi (A/B/C)" :value="old('akreditasi')" />
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.profile.index') }}"
               class="px-8 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg font-medium">
                {{ translateText('Batal') }}
            </a>
            <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow hover:shadow-xl transition">
                {{ translateText('Simpan Profil') }}
            </button>
        </div>
    </form>
</div>
@endsection