{{-- resources/views/admin/galeri/edit.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Edit Gambar Galeri'))

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ translateText('Edit Gambar Galeri') }}</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 rounded-lg">
            <strong>{{ translateText('Terjadi kesalahan!') }}</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PERBAIKAN UTAMA: GANTI PATCH → PUT --}}
    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT') {{-- ← INI YANG HARUS DIGANTI DARI PATCH KE PUT! --}}

        <!-- Gambar Saat Ini -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Gambar Saat Ini') }}</label>
            <img src="{{ asset('storage/' . $galeri->gambar_path) }}" 
                 class="w-full max-h-96 object-cover rounded-lg shadow-sm border" 
                 alt="{{ translateField($galeri, 'caption') ?? 'Galeri LKP MORI' }}">
        </div>

        <!-- Ganti Gambar (Opsional) -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Ganti Gambar') }}</label>
            <input type="file" name="gambar" accept="image/*"
                   class="block w-full text-sm text-gray-500 
                          file:mr-4 file:py-2.5 file:px-5 
                          file:rounded-full file:border-0 
                          file:text-sm file:font-semibold 
                          file:bg-gradient-to-r file:from-orange-500 file:to-teal-600 
                          file:text-white hover:file:from-orange-600 hover:file:to-teal-700 
                          transition-all">
            <p class="mt-1 text-xs text-gray-500">
                {{ translateText('Kosongkan jika tidak ingin mengganti gambar') }}
            </p>
        </div>

        <!-- Caption -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Caption') }}</label>
            <input type="text" name="caption" value="{{ old('caption', translateField($galeri, 'caption')) }}"
                   class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 
                          bg-white dark:bg-zinc-800" placeholder="{{ translateText('Masukkan caption...') }}">
            <p class="mt-1 text-xs text-gray-500">
                {{ translateText('Otomatis diterjemahkan ulang ke Inggris & Jepang') }}
            </p>
        </div>

        <!-- Preview Terjemahan (Opsional) -->
        @if(old('caption', translateField($galeri, 'caption')))
            <div class="p-4 bg-gradient-to-r from-gray-50 to-zinc-50 dark:from-zinc-800 rounded-lg text-sm border">
                <p class="font-medium text-gray-700 dark:text-gray-300 mb-2">{{ translateText('Preview Terjemahan:') }}</p>
                <p><strong>EN:</strong> {{ app(\App\Services\TranslationService::class)->translate(old('caption', translateField($galeri, 'caption')), 'en') }}</p>
                <p><strong>JA:</strong> {{ app(\App\Services\TranslationService::class)->translate(old('caption', translateField($galeri, 'caption')), 'ja') }}</p>
            </div>
        @endif

        <!-- Tombol Aksi -->
        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-7 py-3 bg-gradient-to-r from-orange-500 to-teal-600 text-white font-medium rounded-lg 
                                          hover:from-orange-600 hover:to-teal-700 transform hover:scale-105 transition-all shadow-lg">
                {{ translateText('Simpan Perubahan') }}
            </button>
            <a href="{{ route('admin.galeri.index') }}" class="px-7 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg 
                                                          hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection