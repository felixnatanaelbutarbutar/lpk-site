{{-- resources/views/admin/profile/index.blade.php --}}
@extends('layouts.admin.layout')

@section('page-title', translateText('Manajemen Profil LKP'))

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">{{ translateText('Profil Lembaga') }}</h1>
        <a href="{{ route('admin.profile.edit') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow hover:shadow-xl transition">
            <i data-lucide="edit-3" class="w-5 h-5"></i>
            {{ translateText('Edit Profil') }}
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-5 bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-300 dark:border-emerald-700 text-emerald-800 dark:text-emerald-200 rounded-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-6 h-6"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border overflow-hidden">
        <!-- Header dengan Logo -->
        <div class="relative h-48 bg-gradient-to-r from-indigo-600 to-purple-700">
            <div class="absolute bottom-0 left-8 transform translate-y-1/2">
                @if($profile->logo_path)
                    <img src="{{ asset('storage/'.$profile->logo_path) }}"
                         alt="{{ translateField($profile, 'nama') }}"
                         class="w-32 h-32 rounded-full ring-8 ring-white dark:ring-zinc-800 object-contain shadow-2xl bg-white">
                @else
                    <div class="w-32 h-32 rounded-full bg-white dark:bg-zinc-700 flex items-center justify-center text-4xl font-bold text-indigo-600 shadow-2xl">
                        {{ Str::substr(translateField($profile, 'nama'), 0, 2) }}
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-20 px-8 pb-8">
            <!-- NAMA & ALAMAT → PAKAI translateField -->
            <h2 class="text-3xl font-bold mb-2">{{ translateField($profile, 'nama') }}</h2>
            <p class="text-gray-600 dark:text-zinc-400 mb-6">
                {{ translateField($profile, 'alamat') ?: translateText('Alamat belum diisi') }}
            </p>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600 dark:text-indigo-400">
                        {{ translateText('Informasi Umum') }}
                    </h3>
                    <table class="w-full text-sm">
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('Direktur') }}</td>
                            <td>: {{ $profile->direktur ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('Website') }}</td>
                            <td>:
                                @if($profile->website)
                                    <a href="{{ $profile->website }}" target="_blank" class="text-indigo-600 underline hover:text-indigo-800">
                                        {{ $profile->website }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('NPWP') }}</td>
                            <td>: {{ $profile->npwp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('Tanggal Pendirian') }}</td>
                            <td>:
                                @if($profile->tanggal_pendirian)
                                    {{ \Carbon\Carbon::parse($profile->tanggal_pendirian)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-4 text-purple-600 dark:text-purple-400">
                        {{ translateText('Perizinan & Akreditasi') }}
                    </h3>
                    <table class="w-full text-sm">
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('SK Pendirian') }}</td>
                            <td>: {{ $profile->sk ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('NIB / OSS') }}</td>
                            <td>: {{ $profile->perizinan_berusaha ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('Registrasi Kemnaker') }}</td>
                            <td>: {{ $profile->kementrian_ketenagakerjaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 pr-4 font-medium">{{ translateText('Akreditasi') }}</td>
                            <td>:
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $profile->akreditasi === 'A' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $profile->akreditasi ?? translateText('Belum') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="mt-10 grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-indigo-600 dark:text-indigo-400">{{ translateText('Visi') }}</h3>
                    <div class="text-gray-700 dark:text-zinc-300 leading-relaxed">
                        {!! translateField($profile, 'visi') ? nl2br(e(translateField($profile, 'visi'))) : '<em class="text-gray-500">' . translateText('Belum diisi') . '</em>' !!}
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-purple-600 dark:text-purple-400">{{ translateText('Misi') }}</h3>
                    <div class="text-gray-700 dark:text-zinc-300 leading-relaxed">
                        {!! translateField($profile, 'misi') ? nl2br(e(translateField($profile, 'misi'))) : '<em class="text-gray-500">' . translateText('Belum diisi') . '</em>' !!}
                    </div>
                </div>
            </div>

            <!-- Sejarah -->
            @if(translateField($profile, 'sejarah'))
                <div class="mt-10">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600 dark:text-indigo-400">{{ translateText('Sejarah Singkat') }}</h3>
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-zinc-300">
                        {!! nl2br(e(translateField($profile, 'sejarah'))) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush