{{-- resources/views/galeri.blade.php --}}
@extends('layouts.app')

@section('title', translateText('Galeri Sekolah'))

@section('content')
<style>
    :root {
        --brand-orange: #f84e01;
        --brand-teal: #0d7e84;
        --brand-gold: #eaac59;
        --brand-green: #43ca88;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .gallery-item {
        animation: fadeIn 0.5s ease-out forwards;
        animation-delay: calc(var(--index) * 0.05s);
        opacity: 0;
    }
    
    .image-hover-effect {
        position: relative;
        overflow: hidden;
    }
    
    .image-hover-effect::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(248, 78, 1, 0.8) 0%, rgba(13, 126, 132, 0.8) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }
    
    .image-hover-effect:hover::before {
        opacity: 1;
    }
    
    .hover-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        z-index: 2;
        transition: transform 0.3s ease;
        color: white;
    }
    
    .image-hover-effect:hover .hover-icon {
        transform: translate(-50%, -50%) scale(1);
    }
</style>

{{-- Hero Header --}}
<div class="relative py-16 mb-8" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 50%, #43ca88 100%);">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
            {{ translateText('Galeri Sekolah') }}
        </h1>
        <p class="text-white/90 text-lg max-w-2xl mx-auto">
            {{ translateText('Dokumentasi kegiatan pelatihan, fasilitas, dan momen berkesan di LPK MORI') }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-12">
    @if($galeri->isEmpty())
        {{-- Empty State --}}
        <div class="text-center py-20">
            <div class="w-32 h-32 mx-auto mb-6 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #f84e01 0%, #eaac59 100%);">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2" style="color: #0d7e84;">
                {{ translateText('Belum ada gambar di galeri') }}
            </h3>
            <p class="text-gray-600 text-lg">
                {{ translateText('Galeri akan segera diisi dengan foto-foto kegiatan terbaru') }}
            </p>
        </div>
    @else
        {{-- Stats Bar --}}
        <div class="mb-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl p-4 text-center border-2" style="border-color: #f84e01;">
                <div class="text-3xl font-bold mb-1" style="color: #f84e01;">{{ $galeri->count() }}</div>
                <div class="text-sm text-gray-600">{{ translateText('Total Foto') }}</div>
            </div>
            <div class="bg-white rounded-xl p-4 text-center border-2" style="border-color: #0d7e84;">
                <div class="text-3xl font-bold mb-1" style="color: #0d7e84;">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="text-sm text-gray-600">{{ translateText('Kegiatan') }}</div>
            </div>
            <div class="bg-white rounded-xl p-4 text-center border-2" style="border-color: #eaac59;">
                <div class="text-3xl font-bold mb-1" style="color: #eaac59;">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                </div>
                <div class="text-sm text-gray-600">{{ translateText('Fasilitas') }}</div>
            </div>
            <div class="bg-white rounded-xl p-4 text-center border-2" style="border-color: #43ca88;">
                <div class="text-3xl font-bold mb-1" style="color: #43ca88;">
                    <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                </div>
                <div class="text-sm text-gray-600">{{ translateText('Alumni') }}</div>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($galeri as $index => $item)
                <button
                    type="button"
                    class="gallery-item group block text-left rounded-2xl overflow-hidden shadow-lg bg-white hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                    style="--index: {{ $index }};"
                    data-src="{{ asset('storage/' . $item->gambar_path) }}"
                    data-caption="{{ e(translateField($item, 'caption')) }}"
                    data-date="{{ $item->created_at->translatedFormat('d M Y') }}"
                    @if(method_exists($item, 'creator') && $item->creator) 
                        data-creator="{{ $item->creator->name }}" 
                    @else 
                        data-creator="{{ $item->created_by }}" 
                    @endif
                    aria-controls="galeri-modal"
                    aria-haspopup="dialog"
                >
                    <div class="relative aspect-w-4 aspect-h-3 image-hover-effect">
                        <img src="{{ asset('storage/' . $item->gambar_path) }}"
                             loading="lazy"
                             class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="{{ translateField($item, 'caption') }}">
                        
                        {{-- Hover Icon --}}
                        <div class="hover-icon">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>

                        {{-- Category Badge --}}
                        <div class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold text-white backdrop-blur-sm" 
                             style="background-color: rgba(248, 78, 1, 0.9);">
                            📷 Foto
                        </div>
                    </div>

                    @if($item->caption)
                        <div class="p-4">
                            <p class="text-sm font-semibold text-gray-800 line-clamp-2 mb-2">
                                {{ translateField($item, 'caption') }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $item->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>
                    @endif
                </button>
            @endforeach
        </div>
    @endif
</div>

{{-- MODAL --}}
<div id="galeri-modal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-6">
    {{-- Backdrop --}}
    <div id="galeri-backdrop" class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

    <div role="dialog" aria-modal="true" aria-labelledby="galeri-modal-title"
         class="relative max-w-6xl w-full bg-white dark:bg-zinc-900 rounded-2xl overflow-hidden shadow-2xl z-10 animate-fade-in">
        
        {{-- Header --}}
        <div class="flex items-center justify-between p-4 border-b-2" style="border-bottom-color: #eaac59; background: linear-gradient(to right, rgba(248, 78, 1, 0.05), rgba(13, 126, 132, 0.05));">
            <div class="flex items-center gap-3">
                <button id="galeri-prev" 
                        class="p-2 rounded-lg transition-all hover:scale-110" 
                        style="background-color: #f84e01; color: white;"
                        title="Previous" 
                        aria-label="Previous">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
                <button id="galeri-next" 
                        class="p-2 rounded-lg transition-all hover:scale-110" 
                        style="background-color: #0d7e84; color: white;"
                        title="Next" 
                        aria-label="Next">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
                <span id="galeri-counter" class="text-sm font-medium px-3 py-1 rounded-full" style="background-color: #eaac59; color: white;"></span>
            </div>

            <div class="flex items-center gap-3">
                <span id="galeri-date" class="text-sm font-medium text-gray-600 dark:text-gray-400 flex items-center gap-2">
                    <svg class="w-4 h-4" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span></span>
                </span>
                <button id="galeri-close" 
                        class="p-2 rounded-lg transition-all hover:scale-110" 
                        style="background-color: #f84e01; color: white;"
                        aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Image --}}
            <div class="lg:col-span-2 flex items-center justify-center bg-gray-100 dark:bg-zinc-800 rounded-xl overflow-hidden">
                <img id="galeri-modal-image" 
                     src="" 
                     alt="" 
                     class="max-h-[70vh] w-full object-contain" />
            </div>

            {{-- Details --}}
            <div class="lg:col-span-1 space-y-4">
                <div>
                    <h2 id="galeri-modal-title" class="text-2xl font-bold mb-2" style="color: #0d7e84;"></h2>
                    <p id="galeri-modal-caption" class="text-gray-700 dark:text-zinc-300 leading-relaxed"></p>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-zinc-700 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #43ca88;">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500">{{ translateText('Dibuat oleh') }}</div>
                            <div id="galeri-modal-creator" class="font-semibold text-gray-900 dark:text-white"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: #eaac59;">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500">{{ translateText('Tanggal Upload') }}</div>
                            <div id="galeri-modal-date-2" class="font-semibold text-gray-900 dark:text-white"></div>
                        </div>
                    </div>
                </div>

                {{-- Navigation Hint --}}
                <div class="pt-4 border-t border-gray-200 dark:border-zinc-700">
                    <div class="text-xs text-gray-500 space-y-1">
                        <div class="flex items-center gap-2">
                            <kbd class="px-2 py-1 bg-gray-100 dark:bg-zinc-800 rounded text-xs">←</kbd>
                            <kbd class="px-2 py-1 bg-gray-100 dark:bg-zinc-800 rounded text-xs">→</kbd>
                            <span>{{ translateText('Navigasi gambar') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <kbd class="px-2 py-1 bg-gray-100 dark:bg-zinc-800 rounded text-xs">Esc</kbd>
                            <span>{{ translateText('Tutup modal') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('galeri-modal');
        const backdrop = document.getElementById('galeri-backdrop');
        const img = document.getElementById('galeri-modal-image');
        const titleEl = document.getElementById('galeri-modal-title');
        const captionEl = document.getElementById('galeri-modal-caption');
        const creatorEl = document.getElementById('galeri-modal-creator');
        const dateEl = document.getElementById('galeri-date').querySelector('span');
        const dateEl2 = document.getElementById('galeri-modal-date-2');
        const closeBtn = document.getElementById('galeri-close');
        const prevBtn = document.getElementById('galeri-prev');
        const nextBtn = document.getElementById('galeri-next');
        const counterEl = document.getElementById('galeri-counter');

        // Collect items
        const items = Array.from(document.querySelectorAll('[data-src]'));
        let currentIndex = -1;

        function openModal(index) {
            const el = items[index];
            if (!el) return;
            currentIndex = index;

            const src = el.getAttribute('data-src');
            const caption = el.getAttribute('data-caption') || '';
            const date = el.getAttribute('data-date') || '';
            const creator = el.getAttribute('data-creator') || '';

            img.src = src;
            img.alt = caption;
            titleEl.textContent = caption || '{{ translateText("Galeri Sekolah") }}';
            captionEl.textContent = caption;
            creatorEl.textContent = creator;
            dateEl.textContent = date;
            dateEl2.textContent = date;
            counterEl.textContent = `${index + 1} / ${items.length}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            closeBtn.focus();
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            img.src = '';
            currentIndex = -1;
            document.body.style.overflow = '';
        }

        // Click thumbnail
        items.forEach((el, idx) => {
            el.addEventListener('click', () => openModal(idx));
            el.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openModal(idx);
                }
            });
        });

        // Close handlers
        backdrop.addEventListener('click', closeModal);
        closeBtn.addEventListener('click', closeModal);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
            if (e.key === 'ArrowLeft') navigate(-1);
            if (e.key === 'ArrowRight') navigate(1);
        });

        // Next / prev
        function navigate(delta) {
            if (currentIndex === -1) return;
            let next = currentIndex + delta;
            if (next < 0) next = items.length - 1;
            if (next >= items.length) next = 0;
            openModal(next);
        }

        prevBtn.addEventListener('click', () => navigate(-1));
        nextBtn.addEventListener('click', () => navigate(1));
    });
</script>
@endpush