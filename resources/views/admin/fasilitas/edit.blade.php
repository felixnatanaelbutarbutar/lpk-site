{{-- resources/views/admin/fasilitas/edit.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Edit Fasilitas'))

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        {{ translateText('Edit Fasilitas') }}
    </h1>

    <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <!-- Gambar Saat Ini -->
        @if($fasilitas->gambar_path)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                    {{ translateText('Gambar Saat Ini') }}
                </label>
                <img src="{{ asset('storage/' . $fasilitas->gambar_path) }}" 
                     class="w-full h-64 object-cover rounded-lg shadow" alt="Fasilitas">
            </div>
        @endif

        <!-- Ganti Gambar -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                {{ translateText('Ganti Gambar') }}
            </label>
            <input type="file" name="gambar" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
        </div>

        <!-- Nama (Hanya ID) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                {{ translateText('Nama Fasilitas') }} <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="nama" value="{{ old('nama', $fasilitas->nama) }}" required
                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
            <p class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                {{ translateText('Otomatis diterjemahkan ulang') }}
            </p>
        </div>

        <!-- Deskripsi (Hanya ID) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                {{ translateText('Deskripsi') }} <span class="text-rose-500">*</span>
            </label>
            <textarea name="deskripsi" rows="5" required
                      class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
            <p class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                {{ translateText('Otomatis diterjemahkan ulang') }}
            </p>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow hover:shadow-lg transition">
                {{ translateText('Update') }}
            </button>
            <a href="{{ route('admin.fasilitas.index') }}"
               class="px-6 py-2 border border-gray-300 dark:border-zinc-600 text-gray-700 dark:text-zinc-300 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection