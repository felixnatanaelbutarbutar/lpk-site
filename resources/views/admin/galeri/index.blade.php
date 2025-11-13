{{-- resources/views/admin/galeri/index.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Manajemen Galeri'))

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ translateText('Galeri Sekolah') }}</h1>
        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            {{ translateText('Tambah Gambar') }}
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galeri as $item)
            <div class="group relative rounded-xl overflow-hidden shadow-sm border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                <!-- GAMBAR -->
                <div class="aspect-w-1 aspect-h-1">
                    <img src="{{ asset('storage/' . $item->gambar_path) }}"
                         class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                         alt="{{ translateField($item, 'caption') }}">
                </div>

                <!-- CAPTION -->
                @if($item->caption)
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent p-4">
                        <p class="text-white text-sm font-medium line-clamp-2">
                            {{ translateField($item, 'caption') }}
                        </p>
                    </div>
                @endif

                <!-- TANGGAL -->
                <div class="absolute top-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded-md backdrop-blur-sm">
                    {{ $item->created_at->translatedFormat('d M Y') }}
                </div>

                <!-- TOMBOL AKSI (EDIT & HAPUS) -->
                <div class="absolute top-2 right-2 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <!-- EDIT -->
                    <a href="{{ route('admin.galeri.edit', $item) }}"
                       class="flex items-center justify-center w-9 h-9 bg-amber-500 text-white rounded-full shadow-lg hover:bg-amber-600 hover:scale-110 transition-all"
                       title="{{ translateText('Edit') }}">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>

                    <!-- HAPUS -->
                    <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="flex items-center justify-center w-9 h-9 bg-rose-500 text-white rounded-full shadow-lg hover:bg-rose-600 hover:scale-110 transition-all"
                                title="{{ translateText('Hapus') }}"
                                onclick="return confirm('{{ translateText('Hapus gambar ini?') }}')">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <i data-lucide="image-off" class="w-20 h-20 text-gray-300 dark:text-zinc-600 mx-auto mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                    {{ translateText('Belum ada gambar di galeri') }}
                </h3>
                <p class="text-gray-600 dark:text-zinc-400 mb-6">
                    {{ translateText('Tambahkan gambar pertama Anda sekarang!') }}
                </p>
                <a href="{{ route('admin.galeri.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    {{ translateText('Tambah Gambar') }}
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endpush