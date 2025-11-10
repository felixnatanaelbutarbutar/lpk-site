{{-- resources/views/user/pendaftaran/index.blade.php --}}
@extends('layouts.user.layout')

@section('page-title', translateText('Data Pendaftaran Anda'))

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ translateText('Data Pendaftaran Anda') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-zinc-400 mt-1">
                {{ translateText('Kelola pendaftaran program ke Jepang') }}
            </p>
        </div>
        <a href="{{ route('pendaftaran.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i>
            {{ translateText('Buat Baru') }}
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Data Table (Desktop) -->
    @if($pendaftaran->count() > 0)
        <div class="hidden lg:block bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Program') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Nama') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Tgl Lahir') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Pendidikan') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Tujuan') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Status') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">{{ translateText('Dibuat') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">{{ translateText('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                        @foreach($pendaftaran as $data)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors
                                       border-l-4 {{ 
                                           $data->status === 'approved' ? 'border-l-emerald-500' : 
                                           ($data->status === 'rejected' ? 'border-l-rose-500' : 'border-l-amber-500')
                                       }}">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">
                                        {{ translateText($data->program) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($data->foto_ktp_path)
                                            <img src="{{ asset('storage/' . $data->foto_ktp_path) }}" 
                                                 class="w-10 h-10 rounded-full object-cover ring-2 ring-white dark:ring-zinc-700 shadow-sm" alt="KTP">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-sm font-bold shadow-sm">
                                                {{ Str::substr($data->nama_lengkap, 0, 2) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $data->nama_lengkap }}</div>
                                            <div class="text-sm text-gray-500 dark:text-zinc-400">{{ e($data->nomor_whatsapp) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-zinc-300">
                                    {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-zinc-300">
                                    {{ $data->pendidikan_terakhir }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <p class="text-sm text-gray-700 dark:text-zinc-300 truncate" title="{{ translateField($data, 'tujuan_ke_jepang') }}">
                                            {{ Str::limit(translateField($data, 'tujuan_ke_jepang'), 50) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                               {{ $data->status === 'approved' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 
                                                  ($data->status === 'rejected' ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-300' : 
                                                  'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300') }}">
                                        {{ translateText($data->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-zinc-400">
                                    {{ $data->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('pendaftaran.edit', $data->id) }}"
                                           class="p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/30 text-amber-600 dark:text-amber-400 transition-colors"
                                           title="{{ translateText('Edit') }}">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('pendaftaran.destroy', $data->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('{{ translateText('Yakin ingin menghapus?') }}')"
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

        <!-- Mobile Cards -->
        <div class="lg:hidden space-y-4">
            @foreach($pendaftaran as $data)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-5
                            border-l-4 {{ 
                                $data->status === 'approved' ? 'border-l-emerald-500' : 
                                ($data->status === 'rejected' ? 'border-l-rose-500' : 'border-l-amber-500')
                            }}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-3">
                            @if($data->foto_ktp_path)
                                <img src="{{ asset('storage/' . $data->foto_ktp_path) }}" 
                                     class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-zinc-700" alt="KTP">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-sm font-bold">
                                    {{ Str::substr($data->nama_lengkap, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $data->nama_lengkap }}</h3>
                                <p class="text-sm text-gray-500 dark:text-zinc-400">{{ e($data->nomor_whatsapp) }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                   {{ $data->status === 'approved' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 
                                      ($data->status === 'rejected' ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-300' : 
                                      'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300') }}">
                            {{ translateText($data->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                        <div>
                            <span class="text-gray-500 dark:text-zinc-400">{{ translateText('Program')}}:</span>
                            <p class="font-medium text-gray-900 dark:text-white">{{ translateText($data->program) }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500 dark:text-zinc-400">{{ translateText('Lahir')}}:</span>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}
                            </p>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500 dark:text-zinc-400">{{ translateText('Tujuan')}}:</span>
                            <p class="font-medium text-gray-900 dark:text-white truncate">
                                {{ Str::limit(translateField($data, 'tujuan_ke_jepang'), 60) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('pendaftaran.edit', $data->id) }}"
                           class="flex-1 inline-flex justify-center items-center gap-2 px-3 py-2 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-lg font-medium text-sm hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                            {{ translateText('Edit') }}
                        </a>
                        <form action="{{ route('pendaftaran.destroy', $data->id) }}" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('{{ translateText('Yakin ingin menghapus?') }}')"
                                    class="w-full inline-flex justify-center items-center gap-2 px-3 py-2 bg-rose-50 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 rounded-lg font-medium text-sm hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                {{ translateText('Hapus') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 mb-6 text-gray-300 dark:text-zinc-600">
                <i data-lucide="file-text" class="w-full h-full"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                {{ translateText('Belum ada pendaftaran') }}
            </h3>
            <p class="text-gray-600 dark:text-zinc-400 mb-6">
                {{ translateText('Mulai daftar program ke Jepang sekarang!') }}
            </p>
            <a href="{{ route('pendaftaran.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all">
                <i data-lucide="plus" class="w-5 h-5"></i>
                {{ translateText('Daftar Sekarang') }}
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Refresh Lucide icons after Alpine init
    document.addEventListener('alpine:init', () => {
        lucide.createIcons();
    });
</script>
@endpush