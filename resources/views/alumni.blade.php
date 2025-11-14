@extends('layouts.app')

@section('title', 'Alumni')

@section('content')
<style>
    :root {
        --brand-orange: #f84e01;
        --brand-teal: #0d7e84;
        --brand-gold: #eaac59;
        --brand-green: #43ca88;
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .alumni-card {
        animation: slideUp 0.6s ease-out forwards;
        animation-delay: calc(var(--index) * 0.1s);
        opacity: 0;
    }
    
    .testimonial-quote {
        position: relative;
    }
    
    .testimonial-quote::before {
        content: '"';
        position: absolute;
        top: -10px;
        left: -10px;
        font-size: 60px;
        opacity: 0.1;
        font-family: Georgia, serif;
        line-height: 1;
    }
    
    .shine-effect {
        position: relative;
        overflow: hidden;
    }
    
    .shine-effect::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }
    
    .shine-effect:hover::after {
        left: 100%;
    }
</style>

{{-- Hero Header --}}
<div class="relative py-20 mb-12 overflow-hidden" style="background: linear-gradient(135deg, #0d7e84 0%, #43ca88 100%);">
    {{-- Decorative circles --}}
    <div class="absolute top-10 right-10 w-32 h-32 rounded-full opacity-10" style="background-color: #eaac59;"></div>
    <div class="absolute bottom-10 left-10 w-40 h-40 rounded-full opacity-10" style="background-color: #f84e01;"></div>
    
    <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-medium mb-4">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
            </svg>
            Success Stories
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
            Alumni Sukses LPK MORI
        </h1>
        <p class="text-white/90 text-lg max-w-2xl mx-auto">
            Mereka yang telah meraih kesuksesan berkarir di Jepang
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-12">
    {{-- Stats Section --}}
    <div class="mb-12 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="text-center p-6 rounded-2xl shine-effect" style="background: linear-gradient(135deg, #f84e01 0%, rgba(248, 78, 1, 0.8) 100%);">
            <div class="text-4xl font-bold text-white mb-2">2000+</div>
            <div class="text-white/90 text-sm font-medium">Alumni Bekerja</div>
        </div>
        <div class="text-center p-6 rounded-2xl shine-effect" style="background: linear-gradient(135deg, #0d7e84 0%, rgba(13, 126, 132, 0.8) 100%);">
            <div class="text-4xl font-bold text-white mb-2">50+</div>
            <div class="text-white/90 text-sm font-medium">Kota di Jepang</div>
        </div>
        <div class="text-center p-6 rounded-2xl shine-effect" style="background: linear-gradient(135deg, #eaac59 0%, rgba(234, 172, 89, 0.8) 100%);">
            <div class="text-4xl font-bold text-white mb-2">95%</div>
            <div class="text-white/90 text-sm font-medium">Tingkat Kepuasan</div>
        </div>
        <div class="text-center p-6 rounded-2xl shine-effect" style="background: linear-gradient(135deg, #43ca88 0%, rgba(67, 202, 136, 0.8) 100%);">
            <div class="text-4xl font-bold text-white mb-2">15+</div>
            <div class="text-white/90 text-sm font-medium">Tahun Pengalaman</div>
        </div>
    </div>

    {{-- Filter/Search Section (Optional) --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <span class="text-gray-600 font-medium">{{ $alumni->total() }} Alumni</span>
            <span class="text-gray-400">•</span>
            <span class="text-sm text-gray-500">Berbagi pengalaman mereka</span>
        </div>
    </div>

    {{-- Alumni Grid - Masonry Style --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($alumni as $index => $al)
            <div class="alumni-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden" 
                 style="--index: {{ $index }};">
                
                {{-- Card Header with Gradient --}}
                <div class="relative h-32 p-6 flex items-end" 
                     style="background: linear-gradient(135deg, 
                            {{ $loop->iteration % 4 == 1 ? '#f84e01, #eaac59' : 
                               ($loop->iteration % 4 == 2 ? '#0d7e84, #43ca88' : 
                               ($loop->iteration % 4 == 3 ? '#43ca88, #eaac59' : '#eaac59, #f84e01')) }})">
                    
                    {{-- Success Badge --}}
                    <div class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-sm text-white">
                        ⭐ {{ $al->tahun_lulus }}
                    </div>
                    
                    {{-- Avatar --}}
                    <div class="relative">
                        @if($al->foto_path)
                            <img src="{{ asset('storage/' . $al->foto_path) }}" 
                                 alt="{{ $al->nama }}" 
                                 class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        @else
                            @php
                                $parts = explode(' ', trim($al->nama));
                                $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                            @endphp
                            <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-white font-bold text-2xl border-4 border-white shadow-lg bg-white/20 backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                                {{ $initials }}
                            </div>
                        @endif
                        
                        {{-- Online Status Dot --}}
                        <div class="absolute bottom-1 right-1 w-4 h-4 rounded-full border-2 border-white" style="background-color: #43ca88;"></div>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="p-6">
                    {{-- Name & Program --}}
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-[#0d7e84] transition-colors">
                            {{ $al->nama }}
                        </h3>
                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="px-3 py-1 rounded-full font-medium text-white" 
                                  style="background-color: {{ $loop->iteration % 2 == 0 ? '#f84e01' : '#0d7e84' }}">
                                {{ $al->program_label }}
                            </span>
                            @if($al->perusahaan)
                            <span class="px-3 py-1 rounded-full font-medium" style="background-color: #f0fdf4; color: #166534;">
                                🏢 {{ $al->perusahaan }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Testimonial --}}
                    @if($al->getTranslated('pesan'))
                    <div class="testimonial-quote mb-4">
                        <p class="text-gray-600 text-sm leading-relaxed italic line-clamp-4">
                            "{{ \Illuminate\Support\Str::limit($al->getTranslated('pesan'), 180) }}"
                        </p>
                    </div>
                    @endif

                    {{-- Footer Info --}}
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $al->lokasi_kerja ?? 'Jepang' }}</span>
                        </div>
                        
                    </div>
                </div>

                {{-- Hover Border Effect --}}
                <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-[#eaac59] transition-all pointer-events-none"></div>
            </div>
        @endforeach
    </div>

    {{-- Empty State --}}
    @if($alumni->isEmpty())
    <div class="text-center py-20">
        <div class="w-32 h-32 mx-auto mb-6 rounded-full flex items-center justify-center" 
             style="background: linear-gradient(135deg, #0d7e84 0%, #43ca88 100%);">
            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold mb-2" style="color: #0d7e84;">
            Belum Ada Alumni
        </h3>
        <p class="text-gray-600 text-lg">
            Alumni akan segera ditampilkan di halaman ini
        </p>
    </div>
    @endif

    {{-- Pagination with Custom Styling --}}
    @if($alumni->hasPages())
    <div class="mt-12">
        <div class="flex items-center justify-center gap-2">
            {{ $alumni->links() }}
        </div>
    </div>
    @endif

    {{-- CTA Section --}}
    <div class="mt-16 rounded-2xl p-10 text-center" 
         style="background: linear-gradient(135deg, #f84e01 0%, #eaac59 100%);">
        <h2 class="text-3xl font-bold text-white mb-4">
            Ingin Menjadi Alumni Sukses Berikutnya?
        </h2>
        <p class="text-white/90 text-lg mb-6 max-w-2xl mx-auto">
            Bergabunglah dengan ribuan alumni yang telah meraih kesuksesan berkarir di Jepang
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ url('/pendaftaran') }}" 
               class="px-6 py-3 rounded-lg bg-white font-semibold hover:scale-105 transition-transform shadow-lg"
               style="color: #f84e01;">
                Daftar Sekarang
            </a>
            <a href="{{ url('/contact') }}" 
               class="px-6 py-3 rounded-lg border-2 border-white text-white font-semibold hover:bg-white/10 transition-all">
                Konsultasi Gratis
            </a>
        </div>
    </div>
</div>

<style>
    /* Custom Pagination Styling */
    .pagination {
        display: flex;
        gap: 0.5rem;
    }
    
    .pagination a,
    .pagination span {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .pagination a {
        background-color: white;
        color: #0d7e84;
        border: 2px solid #e5e7eb;
    }
    
    .pagination a:hover {
        background-color: #0d7e84;
        color: white;
        border-color: #0d7e84;
        transform: scale(1.05);
    }
    
    .pagination .active span {
        background: linear-gradient(135deg, #f84e01 0%, #eaac59 100%);
        color: white;
        border: 2px solid transparent;
    }
    
    .pagination .disabled span {
        background-color: #f3f4f6;
        color: #9ca3af;
        border: 2px solid #e5e7eb;
    }
</style>
@endsection