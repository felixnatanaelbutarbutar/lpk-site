{{-- resources/views/admin/alumni/create.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Tambah Alumni'))

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ translateText('Tambah Data Alumni') }}</h1>

    <form action="{{ route('admin.alumni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Foto -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Foto Alumni') }}</label>
            <input type="file" name="foto" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600 file:text-white">
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Opsional, max 2MB') }}</p>
        </div>

        <!-- Nama -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Nama Lengkap') }} <span class="text-rose-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
                   class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
        </div>

        <!-- Program (Dropdown) -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Program') }} <span class="text-rose-500">*</span></label>
            <select name="program" required class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
                <option value="GINOU JISSHUUSEI" {{ old('program') === 'GINOU JISSHUUSEI' ? 'selected' : '' }}>
                    Ginou Jisshuusei
                </option>
                <option value="TOKUTEI GINOU (MANDIRI)" {{ old('program') === 'TOKUTEI GINOU (MANDIRI)' ? 'selected' : '' }}>
                    Tokutei Ginou (Mandiri)
                </option>
            </select>
        </div>

        <!-- Tahun Lulus -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Tahun Lulus') }} <span class="text-rose-500">*</span></label>
            <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required min="1900" max="{{ date('Y') + 5 }}"
                   class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">
        </div>

        <!-- Pesan -->
        <div>
            <label class="block font-medium mb-2">{{ translateText('Pesan / Testimoni') }}</label>
            <textarea name="pesan" rows="4" class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-zinc-800">{{ old('pesan') }}</textarea>
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Opsional, otomatis diterjemahkan') }}</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg">
                {{ translateText('Simpan') }}
            </button>
            <a href="{{ route('admin.alumni.index') }}" class="px-6 py-2 border rounded-lg">
                {{ translateText('Batal') }}
            </a>
        </div>
    </form>
</div>
@endsection