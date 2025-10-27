@extends('layouts.app')

@section('title', 'LPK MORI')

@section('content')
  {{-- HERO --}}
  <header class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-indigo-50 via-white to-rose-50"></div>
    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-indigo-200/30 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-rose-200/30 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="max-w-3xl">
        <span class="inline-flex items-center gap-2 text-xs font-medium px-3 py-1 rounded-full bg-indigo-600/10 text-indigo-700 ring-1 ring-indigo-600/20">
          <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2v20M2 12h20"/></svg>
          LPK MORI • Jepang Career Path
        </span>
        <h1 class="mt-4 text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900">
          Kuasai Bahasa Jepang. <span class="text-indigo-600">Buka Peluang Kerja</span> ke Jepang.
        </h1>
        <p class="mt-5 text-lg text-gray-600">
          Program N5–N3, Kaigo & persiapan SSW/TITP dengan sensei berpengalaman.
          Kurikulum terarah, simulasi interview, dan pendampingan dokumen lengkap.
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a href="{{ url('/pendaftaran') }}"
             class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
            Daftar Sekarang
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          </a>
          <a href="{{ url('/about') }}"
             class="inline-flex items-center px-5 py-3 rounded-lg border border-gray-300 hover:bg-gray-50">
            About Us
          </a>
        </div>

        {{-- Stats --}}
        <dl class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4">
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">Alumni bekerja</dt>
            <dd class="text-2xl font-bold">350+</dd>
          </div>
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">Rata waktu N5</dt>
            <dd class="text-2xl font-bold">12–16 minggu</dd>
          </div>
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">Mitra</dt>
            <dd class="text-2xl font-bold">20+</dd>
          </div>
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">Kepuasan</dt>
            <dd class="text-2xl font-bold">98%</dd>
          </div>
        </dl>
      </div>
    </div>
  </header>

  {{-- PROGRAMS --}}
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-end justify-between gap-6">
        <div>
          <h2 class="text-2xl md:text-3xl font-bold">Program Unggulan</h2>
          <p class="mt-2 text-gray-600">Belajar terstruktur dari dasar hingga siap kerja.</p>
        </div>
        <a href="{{ url('/profile') }}" class="hidden sm:inline-block text-sm text-indigo-600 hover:text-indigo-700">Lihat kurikulum →</a>
      </div>

      <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <article class="p-6 rounded-2xl bg-indigo-50/50 ring-1 ring-indigo-100 hover:ring-indigo-200">
          <h3 class="font-semibold text-lg">N5 – Dasar</h3>
          <p class="mt-2 text-gray-600">Hiragana/Katakana, tatabahasa dasar, percakapan sederhana.</p>
          <div class="mt-4 flex items-center justify-between text-sm">
            <span class="px-2 py-1 rounded bg-white ring-1 ring-indigo-100">12–16 minggu</span>
            <a href="{{ url('/pendaftaran') }}" class="text-indigo-600 hover:text-indigo-700">Daftar →</a>
          </div>
        </article>
        <article class="p-6 rounded-2xl bg-white ring-1 ring-gray-100 hover:ring-gray-200">
          <h3 class="font-semibold text-lg">N4 – Menengah</h3>
          <p class="mt-2 text-gray-600">Kosa kata kerja & pola kalimat umum, latihan JLPT.</p>
          <div class="mt-4 flex items-center justify-between text-sm">
            <span class="px-2 py-1 rounded bg-gray-50 ring-1 ring-gray-200">12–16 minggu</span>
            <a href="{{ url('/pendaftaran') }}" class="text-indigo-600 hover:text-indigo-700">Daftar →</a>
          </div>
        </article>
        <article class="p-6 rounded-2xl bg-white ring-1 ring-gray-100 hover:ring-gray-200">
          <h3 class="font-semibold text-lg">Kaigo / SSW</h3>
          <p class="mt-2 text-gray-600">Bahasa & etika kerja perawatan, dokumen & simulasi interview.</p>
          <div class="mt-4 flex items-center justify-between text-sm">
            <span class="px-2 py-1 rounded bg-gray-50 ring-1 ring-gray-200">8–12 minggu</span>
            <a href="{{ url('/pendaftaran') }}" class="text-indigo-600 hover:text-indigo-700">Daftar →</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  {{-- FASILITAS (teaser) --}}
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-8 items-center">
        <div class="order-2 lg:order-1">
          <h2 class="text-2xl md:text-3xl font-bold">Fasilitas Nyaman untuk Belajar Optimal</h2>
          <ul class="mt-4 space-y-3 text-gray-700">
            <li class="flex items-start gap-3">
              <svg class="h-5 w-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12l5 5L20 7"/></svg>
              Ruang kelas ber-AC & multimedia
            </li>
            <li class="flex items-start gap-3">
              <svg class="h-5 w-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12l5 5L20 7"/></svg>
              Sensei berpengalaman + materi JLPT
            </li>
            <li class="flex items-start gap-3">
              <svg class="h-5 w-5 text-indigo-600 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12l5 5L20 7"/></svg>
              Pendampingan dokumen & interview kerja
            </li>
          </ul>
          <a href="{{ url('/fasilitas') }}" class="mt-6 inline-block text-indigo-600 hover:text-indigo-700">Lihat semua fasilitas →</a>
        </div>
        <div class="order-1 lg:order-2">
          <div class="aspect-[16/10] rounded-2xl bg-gradient-to-tr from-indigo-100 via-white to-rose-100 ring-1 ring-gray-200 flex items-center justify-center">
            <span class="text-gray-400">[ preview foto fasilitas ]</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- TESTIMONIAL --}}
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
          <h2 class="text-2xl md:text-3xl font-bold">Cerita Alumni</h2>
          <p class="mt-2 text-gray-600">Bagaimana LPK MORI membantu mereka meraih mimpi ke Jepang.</p>
          <a href="{{ url('/alumni') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-700">Lihat semua alumni →</a>
        </div>
        <div class="lg:col-span-2 grid sm:grid-cols-2 gap-6">
          <figure class="p-6 rounded-2xl bg-gray-50 ring-1 ring-gray-200">
            <blockquote class="text-gray-700">“Materinya jelas, sensei-nya sabar. Lolos interview SSW pertama!”</blockquote>
            <figcaption class="mt-4 text-sm text-gray-500">— Reina, Caregiver (Tokyo)</figcaption>
          </figure>
          <figure class="p-6 rounded-2xl bg-gray-50 ring-1 ring-gray-200">
            <blockquote class="text-gray-700">“Simulasi interview membantu banget. Sekarang kerja di pabrik otomotif.”</blockquote>
            <figcaption class="mt-4 text-sm text-gray-500">— Dimas, Operator (Aichi)</figcaption>
          </figure>
        </div>
      </div>
    </div>
  </section>

  {{-- GALERI TEASER --}}
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-end justify-between">
        <h2 class="text-2xl md:text-3xl font-bold">Galeri Kegiatan</h2>
        <a href="{{ url('/galeri') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Lihat galeri →</a>
      </div>
      <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach(range(1,4) as $g)
          <div class="aspect-[4/3] rounded-xl bg-white ring-1 ring-gray-200 flex items-center justify-center">
            <span class="text-gray-400 text-sm">[ foto {{ $g }} ]</span>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CTA STRIP --}}
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="rounded-2xl bg-indigo-600 px-6 py-8 md:px-10 md:py-10 text-white flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
          <h3 class="text-2xl font-bold">Siap mulai perjalananmu ke Jepang?</h3>
          <p class="mt-1 text-indigo-100">Daftar sekarang, kuota kelas terbatas setiap gelombang.</p>
        </div>
        <a href="{{ url('/pendaftaran') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-white text-indigo-700 hover:bg-indigo-50">
          Pendaftaran Online
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  <footer class="py-10 bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-gray-600 flex flex-col md:flex-row items-center justify-between gap-4">
      <div>© {{ date('Y') }} LPK MORI. All rights reserved.</div>
      <div class="flex items-center gap-4">
        <a href="{{ url('/contact') }}" class="hover:text-indigo-600">Contact Us</a>
        <a href="https://wa.me/62xxxxxxxxxx" class="hover:text-indigo-600">WhatsApp</a>
        <a href="{{ url('/about') }}" class="hover:text-indigo-600">About</a>
      </div>
    </div>
  </footer>
@endsection
