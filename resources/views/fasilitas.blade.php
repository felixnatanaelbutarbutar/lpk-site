{{-- resources/views/fasilitas.blade.php --}}
@extends('layouts.app')

@section('title', translateText('Fasilitas'))

@section('content')
<style>
    :root {
        --brand-orange: #f84e01;
        --brand-teal:   #0d7e84;
        --brand-gold:   #eaac59;
        --brand-green:  #43ca88;
    }
    .animate-fade { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
</style>

{{-- Hero Header --}}
<div class="relative py-20 overflow-hidden" style="background: linear-gradient(135deg, var(--brand-orange) 0%, var(--brand-teal) 55%, var(--brand-green) 100%);">
    <div class="absolute inset-0 bg-black opacity-30"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center z-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
            {{ translateText('Fasilitas LKP MORI') }}
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-4xl mx-auto">
            {{ translateText('Sarana dan prasarana terbaik untuk mendukung proses belajar mengajar') }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($fasilitas as $item)
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-xl overflow-hidden animate-fade" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                @if($item->gambar_path)
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->gambar_path) }}" 
                             alt="{{ translateField($item, 'nama') }}"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    </div>
                @else
                    <div class="h-64 bg-gradient-to-br from-orange-500 to-teal-600 flex items-center justify-center">
                        <span class="text-6xl font-bold text-white opacity-50">
                            {{ Str::substr(translateField($item, 'nama'), 0, 2) }}
                        </span>
                    </div>
                @endif

                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ translateField($item, 'nama') }}
                    </h3>
                    <p class="text-gray-600 dark:text-zinc-400 leading-relaxed">
                        {!! nl2br(e(translateField($item, 'deskripsi'))) !!}
                    </p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="w-32 h-32 mx-auto mb-6 text-gray-300 dark:text-zinc-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-4m-8 0H3m4 0h10" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-3">
                    {{ translateText('Belum Ada Fasilitas') }}
                </h3>
                <p class="text-gray-600 dark:text-zinc-400">
                    {{ translateText('Fasilitas akan segera ditambahkan.') }}
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection