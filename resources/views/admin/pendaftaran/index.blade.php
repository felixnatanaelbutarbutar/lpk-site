@extends('layouts.admin.layout')

@section('page-title', translateText('Admin - Manajemen Pendaftaran'))

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ translateText('Manajemen Pendaftaran') }}</h2>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="mb-4 flex items-center gap-3 p-4 rounded-lg border-2" 
                 style="border-color:#43ca88; background-color:#f0fdf4; color:#166534;">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 
                        7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 
                        0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="mb-4 flex items-center gap-3 p-4 rounded-lg border-2" 
                 style="border-color:#f84e01; background-color:#fef2f2; color:#991b1b;">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" 
                          d="M10 18a8 8 0 100-16 8 8 0 000 
                             16zM8.707 7.293a1 1 0 00-1.414 
                             1.414L8.586 10l-1.293 
                             1.293a1 1 0 101.414 1.414L10 
                             11.414l1.293 1.293a1 1 0 
                             001.414-1.414L11.414 10l1.293-1.293a1 
                             1 0 00-1.414-1.414L10 8.586 
                             8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    {{-- Filter Status --}}
    <div class="flex flex-wrap gap-2">
        @foreach(['pending', 'approved', 'rejected'] as $st)
            <a href="{{ route('admin.pendaftaran.index', ['status' => $st, 'lang' => app()->getLocale()]) }}"
               class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border transition-colors
               {{ $status === $st 
                   ? 'text-white' 
                   : 'text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-600' }}"
               style="background-color: {{ 
                   $status === $st 
                       ? ($st === 'approved' 
                           ? '#43ca88' 
                           : ($st === 'rejected' ? '#f84e01' : '#eaac59')) 
                       : 'transparent' 
               }}">
                {{ translateText(ucfirst($st)) }}
                <span class="px-2 py-0.5 rounded-full text-xs bg-white/30 text-white font-semibold">
                    {{ \App\Models\PendaftaranSiswa::where('status', $st)->count() }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-zinc-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-100 dark:bg-zinc-800">
                <tr>
                    @foreach(['Program','Nama Lengkap','WhatsApp','Tujuan','Dibuat','Status','Aksi'] as $th)
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                            {{ translateText($th) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                @forelse($pendaftaran as $data)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <td class="px-4 py-3">{{ translateText($data->program) }}</td>
                        <td class="px-4 py-3">{{ $data->nama_lengkap }}</td>
                        <td class="px-4 py-3">{{ e($data->nomor_whatsapp) }}</td>
                        <td class="px-4 py-3">{{ translateField($data, 'tujuan_ke_jepang') }}</td>
                        <td class="px-4 py-3">{{ $data->created_at->translatedFormat('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-medium"
                                  style="background-color:
                                  {{ $data->status === 'approved' ? '#dcfce7' :
                                     ($data->status === 'rejected' ? '#fee2e2' : '#fef9c3') }};
                                         color:
                                  {{ $data->status === 'approved' ? '#166534' :
                                     ($data->status === 'rejected' ? '#991b1b' : '#92400e') }};">
                                {{ translateText($data->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            @if($data->status === 'pending')
                                <form action="{{ route('admin.pendaftaran.approve', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            onclick="return confirm('{{ translateText('Setujui pendaftaran ini?') }}')"
                                            class="px-3 py-1 text-xs font-medium rounded-lg text-white" 
                                            style="background-color: #43ca88;">
                                        {{ translateText('Setujui') }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.pendaftaran.reject', ['pendaftaran' => $data->id, 'lang' => app()->getLocale()]) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            onclick="return confirm('{{ translateText('Tolak pendaftaran ini?') }}')"
                                            class="px-3 py-1 text-xs font-medium rounded-lg text-white" 
                                            style="background-color: #f84e01;">
                                        {{ translateText('Tolak') }}
                                    </button>
                                </form>
                            @else
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ translateText('Selesai') }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            {{ translateText('Belum ada pendaftaran.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
