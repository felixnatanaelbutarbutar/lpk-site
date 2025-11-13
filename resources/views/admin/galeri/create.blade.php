{{-- resources/views/admin/galeri/create.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Tambah Galeri'))

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ translateText('Tambah Gambar ke Galeri') }}</h1>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-medium mb-2">{{ translateText('Gambar') }} <span class="text-rose-500">*</span></label>
            <input type="file" name="gambar[]" multiple accept="image/*" required
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Bisa pilih banyak gambar') }}</p>
        </div>

        <div>
            <label class="block font-medium mb-2">{{ translateText('Caption (opsional)') }}</label>
            <input type="text" name="caption" value="{{ old('caption') }}"
                   class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
            <p class="mt-1 text-xs text-gray-500">
                {{ translateText('Otomatis diterjemahkan ke Inggris & Jepang') }}
            </p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg">
                {{ translateText('Simpan') }}
            </button>
            <a href="{{ route('admin.galeri.index') }}" class="px-6 py-2 border rounded-lg">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection