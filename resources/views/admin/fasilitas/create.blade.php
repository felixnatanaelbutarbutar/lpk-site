{{-- resources/views/admin/fasilitas/create.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Tambah Fasilitas'))

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        {{ translateText('Tambah Fasilitas Baru') }}
    </h1>

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

    <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Gambar -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                {{ translateText('Gambar Fasilitas') }} <span class="text-rose-500">*</span>
            </label>
            <input type="file" name="gambar" accept="image/*" required
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
            @error('gambar') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <!-- Nama (Hanya ID) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                {{ translateText('Nama Fasilitas') }} <span class="text-rose-500">*</span>
            </label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
            @error('nama') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            <p class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                {{ translateText('Otomatis diterjemahkan ke Inggris & Jepang') }}
            </p>
        </div>

        <!-- Deskripsi (Hanya ID) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">
                {{ translateText('Deskripsi') }} <span class="text-rose-500">*</span>
            </label>
            <textarea name="deskripsi" rows="5" required
                      class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            <p class="mt-1 text-xs text-gray-500 dark:text-zinc-400">
                {{ translateText('Otomatis diterjemahkan ke Inggris & Jepang') }}
            </p>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow hover:shadow-lg transition">
                {{ translateText('Simpan') }}
            </button>
            <a href="{{ route('admin.fasilitas.index') }}"
               class="px-6 py-2 border border-gray-300 dark:border-zinc-600 text-gray-700 dark:text-zinc-300 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection