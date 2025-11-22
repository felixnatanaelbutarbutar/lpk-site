{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('title', translateText('Profil LKP'))

@section('content')
<style>
    :root {
        --brand-orange: #f84e01;
        --brand-teal:   #0d7e84;
        --brand-gold:   #eaac59;
        --brand-green:  #43ca88;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .animate-fade { 
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
    .delay-3 { animation-delay: 0.6s; }
</style>

{{-- Hero Header – Tetap pakai brand color (ini yang kamu mau) --}}
<div class="relative py-20 overflow-hidden" style="background: linear-gradient(135deg, var(--brand-orange) 0%, var(--brand-teal) 55%, var(--brand-green) 100%);">
    <div class="absolute inset-0 bg-black opacity-25"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center z-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
            {{ translateText('Profil Lembaga') }}
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-4xl mx-auto">
            {{ translateText('Mengenal lebih dekat LKP MORI — Lembaga Kursus dan Pelatihan yang berpengalaman dan terpercaya') }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl overflow-hidden animate-fade">

        {{-- Header Logo – WARNA DIHAPUS, JADI PUTIH BERSIH --}}
        <div class="relative h-64 md:h-80 bg-gray-50 dark:bg-zinc-800">
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2">
                @if($profile->logo_path)
                    <img src="{{ asset('storage/'.$profile->logo_path) }}"
                         alt="{{ translateField($profile, 'nama') }}"
                         class="w-44 h-44 md:w-56 md:h-56 rounded-full ring-12 ring-white dark:ring-zinc-900 object-contain shadow-2xl bg-white">
                @else
                    <div class="w-44 h-44 md:w-56 md:h-56 rounded-full bg-white dark:bg-zinc-700 flex items-center justify-center text-6xl md:text-8xl font-bold text-orange-600 shadow-2xl">
                        {{ Str::substr(translateField($profile, 'nama'), 0, 2) }}
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-28 md:pt-36 px-6 md:px-12 pb-16">

            {{-- Nama & Alamat --}}
            <div class="text-center mb-14 animate-fade delay-1">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-3">
                    {{ translateField($profile, 'nama') }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-zinc-400 max-w-3xl mx-auto">
                    {{ translateField($profile, 'alamat') ?: translateText('Alamat belum diisi') }}
                </p>
            </div>

            {{-- Informasi Umum & Perizinan --}}
            <div class="grid md:grid-cols-2 gap-10 mb-16 animate-fade delay-2">
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 rounded-3xl p-8 border border-orange-200 dark:border-orange-800">
                    <h3 class="text-2xl font-bold mb-6 text-orange-700 dark:text-orange-400">
                        {{ translateText('Informasi Umum') }}
                    </h3>
                    <table class="w-full text-gray-700 dark:text-zinc-300 text-lg">
                        <tr><td class="py-3 font-medium">{{ translateText('Direktur') }}</td><td class="pl-6">: {{ $profile->direktur ?? '-' }}</td></tr>
                        <tr><td class="py-3 font-medium">{{ translateText('Website') }}</td>
                            <td class="pl-6">: @if($profile->website)<a href="{{ $profile->website }}" target="_blank" class="text-orange-600 hover:underline">{{ $profile->website }}</a>@else - @endif</td></tr>
                        <tr><td class="py-3 font-medium">{{ translateText('NPWP') }}</td><td class="pl-6">: {{ $profile->npwp ?? '-' }}</td></tr>
                        <tr><td class="py-3 font-medium">{{ translateText('Tanggal Pendirian') }}</td>
                            <td class="pl-6">: {{ $profile->tanggal_pendirian ? \Carbon\Carbon::parse($profile->tanggal_pendirian)->translatedFormat('d F Y') : '-' }}</td></tr>
                    </table>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-teal-900/20 rounded-3xl p-8 border border-teal-200 dark:border-teal-800">
                    <h3 class="text-2xl font-bold mb-6 text-teal-700 dark:text-teal-400">
                        {{ translateText('Perizinan & Akreditasi') }}
                    </h3>
                    <table class="w-full text-gray-700 dark:text-zinc-300 text-lg">
                        <tr><td class="py-3 font-medium">{{ translateText('SK Pendirian') }}</td><td class="pl-6">: {{ $profile->sk ?? '-' }}</td></tr>
                        <tr><td class="py-3 font-medium">{{ translateText('NIB / OSS') }}</td><td class="pl-6">: {{ $profile->perizinan_berusaha ?? '-' }}</td></tr>
                        <tr><td class="py-3 font-medium">{{ translateText('Registrasi Kemnaker') }}</td><td class="pl-6">: {{ $profile->kementrian_ketenagakerjaan ?? '-' }}</td></tr>
                        <tr><td class="py-3 font-medium">{{ translateText('Akreditasi') }}</td>
                            <td class="pl-6">: 
                                <span class="px-5 py-2 rounded-full text-sm font-bold {{ $profile->akreditasi === 'A' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $profile->akreditasi ?? translateText('Belum') }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Visi & Misi --}}
            <div class="grid md:grid-cols-2 gap-10 mb-16 animate-fade delay-3">
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 rounded-3xl p-10 border border-green-200 dark:border-green-800">
                    <h3 class="text-3xl font-bold mb-6 text-green-700 dark:text-green-400">{{ translateText('Visi') }}</h3>
                    <div class="text-lg leading-relaxed text-gray-700 dark:text-zinc-300">
                        {!! translateField($profile, 'visi') ? nl2br(e(translateField($profile, 'visi'))) : '<em class="text-gray-500">'.translateText('Visi belum diisi').'</em>' !!}
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-50 to-yellow-50 dark:from-amber-900/20 rounded-3xl p-10 border border-amber-200 dark:border-amber-800">
                    <h3 class="text-3xl font-bold mb-6 text-amber-700 dark:text-amber-400">{{ translateText('Misi') }}</h3>
                    <div class="text-lg leading-relaxed text-gray-700 dark:text-zinc-300">
                        {!! translateField($profile, 'misi') ? nl2br(e(translateField($profile, 'misi'))) : '<em class="text-gray-500">'.translateText('Misi belum diisi').'</em>' !!}
                    </div>
                </div>
            </div>

            {{-- Sejarah Singkat --}}
            @if(translateField($profile, 'sejarah'))
            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-3xl p-12 animate-fade delay-3">
                <h3 class="text-4xl font-bold text-center mb-10 text-gray-800 dark:text-white">
                    {{ translateText('Sejarah Singkat') }}
                </h3>
                <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-zinc-300 text-justify leading-relaxed">
                    {!! nl2br(e(translateField($profile, 'sejarah'))) !!}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection