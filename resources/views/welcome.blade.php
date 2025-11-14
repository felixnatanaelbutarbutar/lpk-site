@extends('layouts.app')

@section('title', 'LPK MORI')

@section('content')

{{-- Custom Brand Colors Style --}}
<style>
  :root {
    --brand-orange: #f84e01;
    --brand-teal: #0d7e84;
    --brand-gold: #eaac59;
    --brand-green: #43ca88;
  }
</style>

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
          Ayo Kerja ke Jepang. <span class="hero-accent" style="color: #eaac59;">Berkarya untuk Negeri.</span>
        </h1>

        <p class="mt-6 hero-subtitle">
          Program N5–N3, Kaigo & persiapan SSW/TITP dengan sensei berpengalaman.
        </p>

        <div class="mt-10 flex flex-wrap gap-4 items-center">
          <a href="{{ url('/pendaftaran') }}" class="px-6 py-3 rounded-lg font-medium transition-all hover:scale-105" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%); color: white;">
            Daftar Sekarang
          </a>

          <button id="heroPlayBtn" class="px-5 py-3 rounded-lg border-2 font-medium hover:bg-white/10 transition-all" style="border-color: #43ca88; color: #43ca88;" aria-controls="videoModal" aria-haspopup="dialog" title="Tonton profil LPK MORI">
            <svg class="h-5 w-5 inline-block" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.518-3.76A1 1 0 006 8.236v7.528a1 1 0 001.234.97l6.518-1.882a1 1 0 00.754-.97v-2.664a1 1 0 00-.26-.94z" />
            </svg>
            &nbsp;Tonton Profil
          </button>
        </div>
      </div>

      {{-- RIGHT: image/visual --}}
      <div class="md:col-span-5 lg:col-span-5 relative flex items-center justify-center">
        <div class="visual-card">
          <img src="{{ asset('build/assets/image/Thumbnail.jpg') }}" alt="Preview LPK MORI" class="object-cover w-full h-full rounded-2xl shadow-2xl">
        </div>

        <button id="heroPlayCircle" class="absolute w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform" style="background-color: #f84e01;" aria-controls="videoModal" aria-haspopup="dialog" title="Play">
          <svg class="h-6 w-6 text-white ml-1" viewBox="0 0 24 24" fill="white">
            <path d="M10 8l6 4-6 4V8z" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>

{{-- VIDEO MODAL (YouTube version) --}}
<div id="videoModal" class="fixed inset-0 z-50 hidden items-center justify-center p-6">
  <div id="videoModalBackdrop" class="absolute inset-0 bg-black/70"></div>

  <div class="relative z-10 w-full max-w-5xl px-4">
    <div class="bg-black rounded-xl overflow-hidden shadow-2xl relative" style="border: 3px solid #eaac59;">
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
        class="absolute top-3 right-3 rounded-full p-2 hover:opacity-80 text-white transition-opacity"
        style="background-color: #f84e01;"
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


{{-- COMPANY PROFILE SECTION - setelah HERO, sebelum PROGRAMS --}}
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Profil Perusahaan</h2>
      <p class="mt-3 text-lg text-gray-600">Lembaga Pelatihan Keterampilan (LPK) Minori Medan</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow border-t-4" style="border-top-color: #f84e01;">
        <h3 class="text-lg font-semibold mb-4" style="color: #f84e01;">Identitas Resmi</h3>
        <dl class="space-y-4 text-sm">
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Nama Perusahaan</dt>
            <dd class="font-medium text-gray-900">LPK Mori Silangit</dd>
          </div>
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Direktur</dt>
            <dd class="font-medium text-gray-900">Felix Butarbutar</dd>
          </div>
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Tanggal Pendirian</dt>
            <dd class="font-medium text-gray-900">Oktober 2020</dd>
          </div>
          <div class="flex justify-between pb-3">
            <dt class="text-gray-600">NPWP</dt>
            <dd class="font-medium text-gray-900">50.175.751.2-121.000</dd>
          </div>
        </dl>
      </div>

      <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow border-t-4" style="border-top-color: #0d7e84;">
        <h3 class="text-lg font-semibold mb-4" style="color: #0d7e84;">Akta & Legalitas</h3>
        <dl class="space-y-4 text-sm">
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Notaris Pendirian</dt>
            <dd class="font-medium text-gray-900">JANSIMAN PURBA, S.H</dd>
          </div>
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Akta Perubahan 2023</dt>
            <dd class="font-medium text-gray-900">BERTY TARIGAN, S.H., M.Kn.</dd>
          </div>
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">SK Kemenkumham</dt>
            <dd class="font-medium text-gray-900">AHU-0009690-AH.01.07.2023</dd>
          </div>
          <div class="flex justify-between pb-3">
            <dt class="text-gray-600">OSS Sertifikat Standar</dt>
            <dd class="font-medium text-gray-900">0109230095289001</dd>
          </div>
        </dl>
      </div>

      <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow md:col-span-2 lg:col-span-1 border-t-4" style="border-top-color: #43ca88;">
        <h3 class="text-lg font-semibold mb-4" style="color: #43ca88;">Izin Operasional</h3>
        <dl class="space-y-4 text-sm">
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Dinsos & Tenaga Kerja Medan</dt>
            <dd class="font-medium text-gray-900">506/543/DSTK-M/2010</dd>
          </div>
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Disnaker Medan</dt>
            <dd class="font-medium text-gray-900">563/575.1/DKKM/2017</dd>
          </div>
          <div class="flex justify-between border-b border-gray-100 pb-3">
            <dt class="text-gray-600">Akreditasi LA-LPK</dt>
            <dd class="font-medium text-gray-900">643/LA-LPK/XII/2023</dd>
          </div>
          <div class="flex justify-between pb-3">
            <dt class="text-gray-600">Izin SO Kemnaker RI</dt>
            <dd class="font-medium text-gray-900">2/873/HK.03.01/2024</dd>
          </div>
        </dl>
      </div>
    </div>

    <div class="mt-12 rounded-2xl p-8 text-center" style="background: linear-gradient(135deg, #0d7e84 0%, #43ca88 100%); color: white;">
      <h3 class="text-xl font-semibold mb-3">Alamat & Kontak</h3>
      <p class="max-w-3xl mx-auto opacity-95">
        <strong>Jl. Setia Budi Komplek Kaban Centre Blok C No. 06-07,</strong><br>
        Kel. Tanjung Sari, Kec. Medan Tuntungan,<br>
        Kota Medan, Sumatera Utara 20132
      </p>
      <div class="mt-6 flex flex-wrap justify-center gap-6 text-sm">
        <a href="https://www.lpkminorimedan.co.id" class="text-white hover:text-yellow-200 font-medium transition-colors" style="text-decoration: underline; text-decoration-color: #eaac59;">
          www.lpkminorimedan.co.id
        </a>
        <a href="https://wa.me/62xxxxxxxxxx" class="text-white hover:text-yellow-200 font-medium transition-colors" style="text-decoration: underline; text-decoration-color: #eaac59;">
          WhatsApp Official
        </a>
      </div>
    </div>
  </div>
</section>

{{-- PROGRAMS --}}
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-2xl md:text-3xl font-bold">Program Kerja ke Jepang</h2>
      <p class="mt-2 text-gray-600">Dua jalur program resmi LPK MORI untuk karir Anda di Jepang</p>
    </div>

    <div class="mt-8 grid gap-8 sm:grid-cols-2 max-w-5xl mx-auto">
      {{-- Program Ginou Jisshuu --}}
      <article class="p-8 rounded-2xl bg-white ring-2 hover:shadow-xl transition-all group" style="ring-color: #f84e01;">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #f84e01;">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="font-bold text-xl" style="color: #f84e01;">Ginou Jisshuu (Magang)</h3>
        </div>

        <p class="text-gray-600 leading-relaxed mb-6">
          Program kerja ke Jepang tanpa memerlukan sertifikat keahlian bidang kerja. Cocok untuk fresh graduate atau yang ingin memulai karir di Jepang dengan bimbingan intensif.
        </p>

        <div class="space-y-3 mb-6">
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>Tanpa sertifikat keahlian khusus</span>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>Pelatihan bahasa Jepang N5-N3</span>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>Program TITP resmi pemerintah</span>
          </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t" style="border-top-color: #f84e01;">
          <span class="px-3 py-1.5 rounded-lg font-medium text-sm" style="background-color: #f84e01; color: white;">12-16 Minggu</span>
          <a href="{{ url('/pendaftaran') }}" class="font-medium hover:opacity-80 transition-opacity flex items-center gap-1" style="color: #f84e01;">
            Daftar Sekarang
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </article>

      {{-- Program Tokutei Ginou --}}
      <article class="p-8 rounded-2xl bg-white ring-2 hover:shadow-xl transition-all group" style="ring-color: #0d7e84;">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background-color: #0d7e84;">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
          </div>
          <h3 class="font-bold text-xl" style="color: #0d7e84;">Tokutei Ginou (Mandiri)</h3>
        </div>

        <p class="text-gray-600 leading-relaxed mb-6">
          Program kerja ke Jepang yang membutuhkan sertifikat keterampilan khusus bidang kerja. Untuk profesional yang ingin meningkatkan karir dengan keahlian spesifik yang tersertifikasi.
        </p>

        <div class="space-y-3 mb-6">
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>Memerlukan sertifikat keterampilan</span>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>Program SSW (Specified Skilled Worker)</span>
          </div>
          <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>Bidang kerja spesifik tersertifikasi</span>
          </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t" style="border-top-color: #0d7e84;">
          <span class="px-3 py-1.5 rounded-lg font-medium text-sm" style="background-color: #0d7e84; color: white;">16-20 Minggu</span>
          <a href="{{ url('/pendaftaran') }}" class="font-medium hover:opacity-80 transition-opacity flex items-center gap-1" style="color: #0d7e84;">
            Daftar Sekarang
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </article>
    </div>

    {{-- Info tambahan --}}
    <div class="mt-10 text-center">
      <p class="text-sm text-gray-500 mb-4">Kedua program dilengkapi dengan pelatihan bahasa Jepang dan budaya kerja Jepang</p>
      <a href="{{ url('/profile') }}" class="inline-flex items-center gap-2 text-sm font-medium hover:opacity-80 transition-opacity" style="color: #0d7e84;">
        Lihat Detail Kurikulum
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>
</section>

{{-- ALUMNI SECTION --}}
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Alumni Sukses Kami</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Ribuan alumni LPK MORI telah berkarir sukses di berbagai perusahaan ternama di Jepang
      </p>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
      <div class="text-center p-6 rounded-2xl bg-white shadow-lg border-t-4" style="border-top-color: #f84e01;">
        <div class="text-4xl font-bold mb-2" style="color: #f84e01;">2000+</div>
        <div class="text-sm text-gray-600">Alumni Bekerja</div>
      </div>
      <div class="text-center p-6 rounded-2xl bg-white shadow-lg border-t-4" style="border-top-color: #0d7e84;">
        <div class="text-4xl font-bold mb-2" style="color: #0d7e84;">95%</div>
        <div class="text-sm text-gray-600">Tingkat Kelulusan</div>
      </div>
      <div class="text-center p-6 rounded-2xl bg-white shadow-lg border-t-4" style="border-top-color: #eaac59;">
        <div class="text-4xl font-bold mb-2" style="color: #eaac59;">150+</div>
        <div class="text-sm text-gray-600">Perusahaan Partner</div>
      </div>
      <div class="text-center p-6 rounded-2xl bg-white shadow-lg border-t-4" style="border-top-color: #43ca88;">
        <div class="text-4xl font-bold mb-2" style="color: #43ca88;">15 Tahun</div>
        <div class="text-sm text-gray-600">Pengalaman</div>
      </div>
    </div>

    {{-- Testimonials (dinamis) --}}
    {{-- Testimonials (carousel responsif: desktop 3, tablet 2, mobile 1) --}}
    <div class="relative mb-12">
      {{-- arrows --}}
      <button id="alumni-prev" aria-label="Previous" class="absolute left-0 top-1/2 -translate-y-1/2 z-20 p-2 rounded-full bg-white shadow-md hover:shadow-lg disabled:opacity-40">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button id="alumni-next" aria-label="Next" class="absolute right-0 top-1/2 -translate-y-1/2 z-20 p-2 rounded-full bg-white shadow-md hover:shadow-lg disabled:opacity-40">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>

      {{-- viewport --}}
      <div id="alumni-viewport" class="overflow-hidden">
        {{-- track: inline-flex of cards --}}
        <div id="alumni-track" class="flex gap-8 transition-transform duration-300 will-change-transform">
          @foreach($alumni as $al)
          <div class="alumni-card flex-shrink-0 w-full md:w-1/3 lg:w-1/3">
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow h-full flex flex-col justify-between">
              <div>
                <div class="flex items-center gap-4 mb-4">
                  @php
                  $parts = preg_split('/\s+/', trim($al->nama));
                  $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                  @endphp

                  @if(!empty($al->foto_path))
                  <img src="{{ asset('storage/' . $al->foto_path) }}" alt="{{ $al->nama }}" class="w-16 h-16 rounded-full object-cover" />
                  @else
                  <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl font-bold" style="background: linear-gradient(135deg, #f84e01 0%, #eaac59 100%);">
                    {{ $initials }}
                  </div>
                  @endif

                  <div>
                    <h4 class="font-bold text-gray-900">{{ $al->nama }}</h4>
                    <p class="text-sm text-gray-600">
                      {{ $al->program_label ?? $al->program }}
                      @if($al->tahun_lulus) • Angkatan {{ $al->tahun_lulus }} @endif
                    </p>
                  </div>
                </div>

                <div class="flex gap-1 mb-3">
                  @for($i=0;$i<5;$i++)
                    <svg class="w-5 h-5" style="color: #eaac59;" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    @endfor
                </div>

                <p class="text-gray-600 leading-relaxed italic">
                  {{ $al->getTranslated('pesan') ?? ($al->pesan ?: '—') }}
                </p>
              </div>

              <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs font-medium px-2 py-1 rounded {{ $al->program === 'GINOU JISSHUUSEI' ? 'bg-amber-500 text-white' : 'bg-teal-600 text-white' }}">
                  {{ $al->program_label }}
                </span>

                @if($al->tahun_lulus)
                <span class="text-xs text-gray-500 ml-2">Angkatan {{ $al->tahun_lulus }}</span>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- dots (optional) --}}
      <div id="alumni-dots" class="flex items-center justify-center gap-2 mt-6"></div>
    </div>

    @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('alumni-track');
        const prev = document.getElementById('alumni-prev');
        const next = document.getElementById('alumni-next');
        const dotsWrap = document.getElementById('alumni-dots');
        const viewport = document.getElementById('alumni-viewport');

        // get total items from DOM
        const cards = Array.from(track.children);
        const total = cards.length;

        // responsive visible count function
        function getVisibleCount() {
          const w = window.innerWidth;
          if (w >= 1024) return 3; // lg and up -> 3
          if (w >= 768) return 3; // md -> 3 (keinginan Anda)
          if (w >= 640) return 2; // sm -> 2
          return 1; // xs -> 1
        }

        // compute slide width (in pixels) per card based on viewport
        function setCardWidths() {
          const visible = getVisibleCount();
          // ensure track children width equals viewport width / visible
          const vpWidth = viewport.clientWidth;
          const cardWidth = vpWidth / visible;
          cards.forEach(c => c.style.width = `${cardWidth}px`);
          // after resizing, ensure position still correct
          goToIndex(currentIndex, /*animate=*/ false);
        }

        // pages = number of steps (shift by visible count)
        function getPageCount() {
          const visible = getVisibleCount();
          return Math.max(1, Math.ceil(total / visible));
        }

        // current page index (0..pages-1)
        let currentPage = 0;
        let currentIndex = 0; // used to compute translate

        function updateButtons() {
          const pages = getPageCount();
          prev.disabled = (currentPage === 0);
          next.disabled = (currentPage >= pages - 1);
        }

        function buildDots() {
          dotsWrap.innerHTML = '';
          const pages = getPageCount();
          for (let i = 0; i < pages; i++) {
            const d = document.createElement('button');
            d.className = 'w-2 h-2 rounded-full ' + (i === currentPage ? 'bg-gray-800' : 'bg-gray-300');
            d.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            d.addEventListener('click', () => {
              currentPage = i;
              goToPage(currentPage);
            });
            dotsWrap.appendChild(d);
          }
        }

        function goToIndex(index, animate = true) {
          // index = starting card index to show at leftmost
          const visible = getVisibleCount();
          // clamp index
          index = Math.max(0, Math.min(index, Math.max(0, total - visible)));
          currentIndex = index;
          const offset = index * (cards[0].clientWidth || 0);
          track.style.transitionDuration = animate ? '300ms' : '0ms';
          track.style.transform = `translateX(-${offset}px)`;
          // update page
          currentPage = Math.floor(index / visible);
          updateButtons();
          refreshDots();
        }

        function goToPage(page) {
          const visible = getVisibleCount();
          const index = page * visible;
          goToIndex(index);
        }

        function refreshDots() {
          const dots = Array.from(dotsWrap.children);
          dots.forEach((d, idx) => d.className = 'w-2 h-2 rounded-full ' + (idx === currentPage ? 'bg-gray-800' : 'bg-gray-300'));
        }

        // navigation handlers: shift by visible count
        prev.addEventListener('click', () => {
          const visible = getVisibleCount();
          goToIndex(currentIndex - visible);
        });
        next.addEventListener('click', () => {
          const visible = getVisibleCount();
          goToIndex(currentIndex + visible);
        });

        // keyboard support
        document.addEventListener('keydown', (e) => {
          if (e.key === 'ArrowLeft') prev.click();
          if (e.key === 'ArrowRight') next.click();
        });

        // resize handling
        window.addEventListener('resize', () => {
          setCardWidths();
          buildDots();
          updateButtons();
        });

        // init
        setCardWidths();
        buildDots();
        updateButtons();

        // if total <= visible, disable buttons
        function checkDisableIfNotNeeded() {
          const visible = getVisibleCount();
          if (total <= visible) {
            prev.disabled = true;
            next.disabled = true;
            dotsWrap.innerHTML = '';
          }
        }
        checkDisableIfNotNeeded();
      });
    </script>
    @endpush


    {{-- CTA Alumni --}}
    <div class="text-center rounded-2xl p-10" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 50%, #43ca88 100%);">
      <h3 class="text-2xl font-bold text-white mb-4">Ingin Bergabung dengan Alumni Sukses Kami?</h3>
      <p class="text-white/90 mb-6 max-w-2xl mx-auto">
        Wujudkan impian karir Anda di Jepang bersama LPK MORI. Dapatkan pelatihan terbaik dan kesempatan bekerja di perusahaan-perusahaan ternama.
      </p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="{{ route('pendaftaran.index') }}" class="px-6 py-3 rounded-lg bg-white font-medium hover:scale-105 transition-transform" style="color: #f84e01;">
          Daftar Sekarang
        </a>
        <a href="{{ route('alumni') }}" class="px-6 py-3 rounded-lg border-2 border-white text-white font-medium hover:bg-white/10 transition-all">
          Lihat Lebih Banyak Alumni
        </a>
      </div>
    </div>
  </div>
</section>


{{-- CTA STRIP --}}
<!-- <section class="py-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-2xl px-6 py-8 md:px-10 md:py-10 text-white flex flex-col md:flex-row items-center justify-between gap-4" style="background: linear-gradient(135deg, #f84e01 0%, #eaac59 100%);">
      <div>
        <h3 class="text-2xl font-bold">{{ __('home.cta_title') }}</h3>
        <p class="mt-1 opacity-90">{{ __('home.cta_subtitle') }}</p>
      </div>
      <a href="{{ url('/pendaftaran') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg font-medium hover:scale-105 transition-transform" style="background-color: white; color: #f84e01;">
        {{ __('home.cta_button') }}
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>
</section> -->


@endsection