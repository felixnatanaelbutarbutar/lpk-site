@extends('layouts.app')

@section('title', 'LPK MORI')

@section('content')
{{-- HERO --}}
{{-- HERO: left text (fixed copy) + right visual + modal play --}}
<header class="relative bg-black text-white overflow-hidden">
  {{-- background dim layer (optional) --}}
  <div class="absolute inset-0 -z-10">
    <img src="{{ asset('build/assets/image/Thumbnail.jpg') }}" alt="" class="w-full h-full object-cover brightness-50">
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
      {{-- LEFT: text --}}
      <div class="md:col-span-7 lg:col-span-7">
        <h1 class="hero-headline">
          Ayo Kerja ke Jepang. <span class="hero-accent">Berkarya untuk Negeri.</span>
        </h1>

        <p class="mt-6 hero-subtitle">
          Program N5–N3, Kaigo & persiapan SSW/TITP dengan sensei berpengalaman.
        </p>

        <div class="mt-10 flex flex-wrap gap-4 items-center">
          <a href="{{ url('/pendaftaran') }}" class="btn-primary">
            Daftar Sekarang
          </a>

          <button id="heroPlayBtn" class="btn-ghost" aria-controls="videoModal" aria-haspopup="dialog" title="Tonton profil LPK MORI">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.518-3.76A1 1 0 006 8.236v7.528a1 1 0 001.234.97l6.518-1.882a1 1 0 00.754-.97v-2.664a1 1 0 00-.26-.94z" />
            </svg>
            &nbsp;Tonton Profil
          </button>
        </div>
      </div>

      {{-- RIGHT: image/visual --}}
      <div class="md:col-span-5 lg:col-span-5 relative flex items-center justify-center">
        <div class="visual-card">
          <img src="{{ asset('build/assets/image/Thumbnail.jpg') }}" alt="Preview LPK MORI" class="object-cover w-full h-full">
        </div>

        <button id="heroPlayCircle" class="play-circle" aria-controls="videoModal" aria-haspopup="dialog" title="Play">
          <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.4" fill="transparent" />
            <path d="M10 8l6 4-6 4V8z" fill="white" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>

{{-- VIDEO MODAL (YouTube version) --}}
{{-- VIDEO MODAL (YouTube, fallback aspect tanpa plugin Tailwind) --}}
<div id="videoModal" class="fixed inset-0 z-50 hidden items-center justify-center p-6">
  <div id="videoModalBackdrop" class="absolute inset-0 bg-black/70"></div>

  <div class="relative z-10 w-full max-w-5xl px-4">
    <div class="bg-black rounded-xl overflow-hidden shadow-2xl relative">
      {{-- Responsive wrapper (56.25% = 16:9) --}}
      <div class="relative pb-[56.25%] h-0">
        <iframe id="youtubeFrame"
          class="absolute inset-0 w-full h-full"
          src=""
          title="LPK MORI Company Profile"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen>
        </iframe>
      </div>

      {{-- Tombol Close --}}
      <button id="videoModalClose"
        class="absolute top-3 right-3 rounded-full bg-black/60 p-2 hover:bg-black/80 text-white"
        aria-label="Close video">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
</div>

{{-- INLINE SCRIPT: langsung di-render (tidak pake @push) --}}
<script>
  (function() {
    // tunggu DOM siap
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('videoModal');
      const backdrop = document.getElementById('videoModalBackdrop');
      const playBtn = document.getElementById('heroPlayBtn');
      const playCircle = document.getElementById('heroPlayCircle');
      const closeBtn = document.getElementById('videoModalClose');
      const iframe = document.getElementById('youtubeFrame');

      if (!modal || !iframe) return console.warn('Video modal elements not found');

      // gunakan embed tanpa parameter 'si' dan tambahkan rel=0 untuk bersih
      const youtubeBase = "https://www.youtube.com/embed/bdumzRDz1ro?rel=0";

      const openModal = () => {
        // show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        // set src dengan autoplay
        iframe.src = youtubeBase + "&autoplay=1";
        // lock scroll
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
        // fokus ke close button
        if (closeBtn) closeBtn.focus();
      };

      const closeModal = () => {
        // stop video: reset src
        iframe.src = "";
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.documentElement.style.overflow = '';
        document.body.style.overflow = '';
        // kembalikan fokus ke tombol play (jika ada)
        if (playBtn) playBtn.focus();
      };

      // attach events safely (cek eksistensi)
      if (playBtn) playBtn.addEventListener('click', openModal);
      if (playCircle) playCircle.addEventListener('click', openModal);
      if (closeBtn) closeBtn.addEventListener('click', closeModal);
      if (backdrop) backdrop.addEventListener('click', closeModal);

      // ESC to close
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
      });

      // Debug: lihat error console kalau ada
      try {
        // noop
      } catch (err) {
        console.error(err);
      }
    });
  })();
</script>




{{-- PROGRAMS --}}
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between gap-6">
      <div>
        <h2 class="text-2xl md:text-3xl font-bold">{{ __('home.program_title') }}</h2>
        <p class="mt-2 text-gray-600">{{ __('home.program_subtitle') }}</p>
      </div>
      <a href="{{ url('/profile') }}" class="hidden sm:inline-block text-sm text-indigo-600 hover:text-indigo-700">{{ __('home.view_curriculum') }} →</a>
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <article class="p-6 rounded-2xl bg-indigo-50/50 ring-1 ring-indigo-100 hover:ring-indigo-200">
        <h3 class="font-semibold text-lg">{{ __('home.program_n5_title') }}</h3>
        <p class="mt-2 text-gray-600">{{ __('home.program_n5_desc') }}</p>
        <div class="mt-4 flex items-center justify-between text-sm">
          <span class="px-2 py-1 rounded bg-white ring-1 ring-indigo-100">12–16 {{ __('home.weeks') }}</span>
          <a href="{{ url('/pendaftaran') }}" class="text-indigo-600 hover:text-indigo-700">{{ __('home.register_now') }} →</a>
        </div>
      </article>

      <article class="p-6 rounded-2xl bg-white ring-1 ring-gray-100 hover:ring-gray-200">
        <h3 class="font-semibold text-lg">{{ __('home.program_n4_title') }}</h3>
        <p class="mt-2 text-gray-600">{{ __('home.program_n4_desc') }}</p>
        <div class="mt-4 flex items-center justify-between text-sm">
          <span class="px-2 py-1 rounded bg-gray-50 ring-1 ring-gray-200">12–16 {{ __('home.weeks') }}</span>
          <a href="{{ url('/pendaftaran') }}" class="text-indigo-600 hover:text-indigo-700">{{ __('home.register_now') }} →</a>
        </div>
      </article>

      <article class="p-6 rounded-2xl bg-white ring-1 ring-gray-100 hover:ring-gray-200">
        <h3 class="font-semibold text-lg">{{ __('home.program_kaigo_title') }}</h3>
        <p class="mt-2 text-gray-600">{{ __('home.program_kaigo_desc') }}</p>
        <div class="mt-4 flex items-center justify-between text-sm">
          <span class="px-2 py-1 rounded bg-gray-50 ring-1 ring-gray-200">8–12 {{ __('home.weeks') }}</span>
          <a href="{{ url('/pendaftaran') }}" class="text-indigo-600 hover:text-indigo-700">{{ __('home.register_now') }} →</a>
        </div>
      </article>
    </div>
  </div>
</section>

{{-- CTA STRIP --}}
<section class="py-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-2xl bg-indigo-600 px-6 py-8 md:px-10 md:py-10 text-white flex flex-col md:flex-row items-center justify-between gap-4">
      <div>
        <h3 class="text-2xl font-bold">{{ __('home.cta_title') }}</h3>
        <p class="mt-1 text-indigo-100">{{ __('home.cta_subtitle') }}</p>
      </div>
      <a href="{{ url('/pendaftaran') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-white text-indigo-700 hover:bg-indigo-50">
        {{ __('home.cta_button') }}
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>
</section>

{{-- FOOTER --}}
<footer class="py-10 bg-white border-t">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-gray-600 flex flex-col md:flex-row items-center justify-between gap-4">
    <div>© {{ date('Y') }} LPK MORI. {{ __('home.footer_rights') }}</div>
    <div class="flex items-center gap-4">
      <a href="{{ url('/contact') }}" class="hover:text-indigo-600">{{ __('home.contact_us') }}</a>
      <a href="https://wa.me/62xxxxxxxxxx" class="hover:text-indigo-600">WhatsApp</a>
      <a href="{{ url('/about') }}" class="hover:text-indigo-600">{{ __('home.about_us') }}</a>
    </div>
  </div>
</footer>
@endsection