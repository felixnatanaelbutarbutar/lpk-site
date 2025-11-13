{{-- resources/views/admin/alumni/index.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Manajemen Alumni'))

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ translateText('Daftar Alumni') }}</h1>
        <a href="{{ route('admin.alumni.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            {{ translateText('Tambah Alumni') }}
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($alumni as $item)
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border p-6 hover:shadow-lg transition">
                <div class="flex items-start gap-4">
                    @if($item->foto_path)
                        <img src="{{ asset('storage/' . $item->foto_path) }}"
                             class="w-16 h-16 rounded-full object-cover ring-2 ring-white dark:ring-zinc-700">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                            {{ Str::substr($item->nama, 0, 2) }}
                        </div>
                    @endif

                    <div class="flex-1">
                        <h3 class="font-semibold text-lg">{{ $item->nama }}</h3>
                        <p class="text-sm text-gray-600 dark:text-zinc-400">
                            {{ $item->program_label }} • {{ $item->tahun_lulus }}
                        </p>
                        @if($item->pesan)
                            <p class="mt-2 text-sm text-gray-700 dark:text-zinc-300 line-clamp-2">
                                "{{ translateField($item, 'pesan') }}"
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.alumni.edit', $item) }}"
                       class="flex-1 inline-flex justify-center items-center gap-1 px-3 py-2 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-lg font-medium text-sm hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                        {{ translateText('Edit') }}
                    </a>
                    <form action="{{ route('admin.alumni.destroy', $item) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex justify-center items-center gap-1 px-3 py-2 bg-rose-50 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 rounded-lg font-medium text-sm hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors"
                                onclick="return confirm('{{ translateText('Hapus alumni ini?') }}')">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            {{ translateText('Hapus') }}
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $alumni->links() }}
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