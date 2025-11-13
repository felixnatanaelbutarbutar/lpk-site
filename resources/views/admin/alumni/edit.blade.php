{{-- resources/views/admin/alumni/edit.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Edit Alumni'))

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ translateText('Edit Data Alumni') }}</h1>

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

    <form action="{{ route('admin.alumni.update', $alumni) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PATCH')

        <!-- Foto Saat Ini -->
        @if($alumni->foto_path)
            <div>
                <label class="block font-medium mb-2">{{ translateText('Foto Saat Ini') }}</label>
                <img src="{{ asset('storage/' . $alumni->foto_path) }}" 
                     class="w-32 h-32 rounded-full object-cover ring-4 ring-white dark:ring-zinc-700 shadow-sm" 
                     alt="{{ $alumni->nama }}">
            </div>
        @endif

        <!-- Ganti Foto -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Ganti Foto') }}</label>
            <input type="file" name="foto" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Kosongkan jika tidak ingin ganti') }}</p>
        </div>

        <!-- Nama -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Nama Lengkap') }} <span class="text-rose-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama', $alumni->nama) }}" required
                   class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
        </div>

        <!-- Program -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Program') }} <span class="text-rose-500">*</span></label>
            <select name="program" required class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
                <option value="GINOU JISSHUUSEI" {{ old('program', $alumni->program) === 'GINOU JISSHUUSEI' ? 'selected' : '' }}>
                    Ginou Jisshuusei
                </option>
                <option value="TOKUTEI GINOU (MANDIRI)" {{ old('program', $alumni->program) === 'TOKUTEI GINOU (MANDIRI)' ? 'selected' : '' }}>
                    Tokutei Ginou (Mandiri)
                </option>
            </select>
        </div>

        <!-- Tahun Lulus -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Tahun Lulus') }} <span class="text-rose-500">*</span></label>
            <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" required min="1900" max="{{ date('Y') + 5 }}"
                   class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
        </div>

        <!-- Pesan -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Pesan / Testimoni') }}</label>
            <textarea name="pesan" rows="4" class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">{{ old('pesan', $alumni->pesan) }}</textarea>
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Otomatis diterjemahkan ulang') }}</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg">
                {{ translateText('Simpan Perubahan') }}
            </button>
            <a href="{{ route('admin.alumni.index') }}" class="px-6 py-2 border rounded-lg">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection