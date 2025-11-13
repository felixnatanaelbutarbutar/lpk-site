{{-- resources/views/admin/galeri/edit.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Edit Gambar Galeri'))

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ translateText('Edit Gambar Galeri') }}</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 rounded-lg">
            <strong>{{ translateText('Terjadi kesalahan!') }}</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PATCH')

        <!-- Gambar Saat Ini -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Gambar Saat Ini') }}</label>
            <img src="{{ asset('storage/' . $galeri->gambar_path) }}" 
                 class="w-full h-64 object-cover rounded-lg shadow-sm" 
                 alt="{{ translateField($galeri, 'caption') }}">
        </div>

        <!-- Ganti Gambar (Opsional) -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Ganti Gambar') }}</label>
            <input type="file" name="gambar" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Kosongkan jika tidak ingin ganti') }}</p>
        </div>

        <!-- Caption -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Caption') }}</label>
            <input type="text" name="caption" value="{{ old('caption', $galeri->caption) }}"
                   class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
            <p class="mt-1 text-xs text-gray-500">
                {{ translateText('Otomatis diterjemahkan ulang ke Inggris & Jepang') }}
            </p>
        </div>

        <!-- Preview Terjemahan (Opsional) -->
        @if(old('caption', $galeri->caption))
            <div class="p-3 bg-gray-50 dark:bg-zinc-800 rounded text-sm">
                <strong>EN:</strong> {{ app(\App\Services\TranslationService::class)->translate(old('caption', $galeri->caption), 'en') }}<br>
                <strong>JA:</strong> {{ app(\App\Services\TranslationService::class)->translate(old('caption', $galeri->caption), 'ja') }}
            </div>
        @endif

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg">
                {{ translateText('Simpan Perubahan') }}
            </button>
            <a href="{{ route('admin.galeri.index') }}" class="px-6 py-2 border rounded-lg">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection