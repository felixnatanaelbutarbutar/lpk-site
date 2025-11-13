{{-- resources/views/admin/fasilitas/index.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Manajemen Fasilitas'))

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ translateText('Daftar Fasilitas') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-zinc-400 mt-1">
                {{ translateText('Kelola fasilitas sekolah') }}
            </p>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            {{ translateText('Tambah Fasilitas') }}
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Desktop: Table View -->
    @if($fasilitas->count() > 0)
        <div class="hidden lg:block bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Gambar') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Nama') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Deskripsi') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Dibuat') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">{{ translateText('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                        @foreach($fasilitas as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    @if($item->gambar_path)
                                        <img src="{{ asset('storage/' . $item->gambar_path) }}" 
                                             class="w-12 h-12 rounded-lg object-cover ring-2 ring-white dark:ring-zinc-700 shadow-sm" 
                                             alt="{{ translateField($item, 'nama') }}">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                                            {{ Str::substr(translateField($item, 'nama'), 0, 2) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ translateField($item, 'nama') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="text-sm text-gray-700 dark:text-zinc-300 truncate" 
                                           title="{{ translateField($item, 'deskripsi') }}">
                                            {{ Str::limit(translateField($item, 'deskripsi'), 60) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">
                                    {{ $item->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.fasilitas.edit', $item) }}"
                                           class="p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/30 text-amber-600 dark:text-amber-400 transition-colors"
                                           title="{{ translateText('Edit') }}">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('admin.fasilitas.destroy', $item) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('{{ translateText('Hapus fasilitas ini?') }}')"
                                                    class="p-2 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-900/30 text-rose-600 dark:text-rose-400 transition-colors"
                                                    title="{{ translateText('Hapus') }}">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile: Card View -->
        <div class="lg:hidden space-y-4">
            @foreach($fasilitas as $item)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-5">
                    <div class="flex items-start gap-4 mb-3">
                        @if($item->gambar_path)
                            <img src="{{ asset('storage/' . $item->gambar_path) }}" 
                                 class="w-16 h-16 rounded-lg object-cover ring-2 ring-white dark:ring-zinc-700" 
                                 alt="{{ translateField($item, 'nama') }}">
                        @else
                            <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-sm font-bold">
                                {{ Str::substr(translateField($item, 'nama'), 0, 2) }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                {{ translateField($item, 'nama') }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-zinc-400 mt-1">
                                {{ Str::limit(translateField($item, 'deskripsi'), 80) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.fasilitas.edit', $item) }}"
                           class="flex-1 inline-flex justify-center items-center gap-2 px-3 py-2 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-lg font-medium text-sm hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                            {{ translateText('Edit') }}
                        </a>
                        <form action="{{ route('admin.fasilitas.destroy', $item) }}" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('{{ translateText('Hapus fasilitas ini?') }}')"
                                    class="w-full inline-flex justify-center items-center gap-2 px-3 py-2 bg-rose-50 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 rounded-lg font-medium text-sm hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                {{ translateText('Hapus') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $fasilitas->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 mb-6 text-gray-300 dark:text-zinc-600">
                <i data-lucide="home" class="w-full h-full"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                {{ translateText('Belum ada fasilitas') }}
            </h3>
            <p class="text-gray-600 dark:text-zinc-400 mb-6">
                {{ translateText('Tambahkan fasilitas sekolah sekarang!') }}
            </p>
            <a href="{{ route('admin.fasilitas.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
                <i data-lucide="plus" class="w-5 h-5"></i>
                {{ translateText('Tambah Fasilitas') }}
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endpush