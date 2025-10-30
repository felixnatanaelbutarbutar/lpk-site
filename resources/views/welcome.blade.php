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
          {{ __('home.hero_tagline') }}
        </span>
        <h1 class="mt-4 text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900">
          {{ __('home.hero_title') }}
        </h1>
        <p class="mt-5 text-lg text-gray-600">
          {{ __('home.hero_subtitle') }}
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a href="{{ url('/pendaftaran') }}"
             class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
            {{ __('home.register_now') }}
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
          </a>
          <a href="{{ url('/about') }}"
             class="inline-flex items-center px-5 py-3 rounded-lg border border-gray-300 hover:bg-gray-50">
            {{ __('home.about_us') }}
          </a>
        </div>

        {{-- Stats --}}
        <dl class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4">
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">{{ __('home.stats_alumni') }}</dt>
            <dd class="text-2xl font-bold">350+</dd>
          </div>
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">{{ __('home.stats_n5') }}</dt>
            <dd class="text-2xl font-bold">12–16 {{ __('home.weeks') }}</dd>
          </div>
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">{{ __('home.stats_partners') }}</dt>
            <dd class="text-2xl font-bold">20+</dd>
          </div>
          <div class="p-4 rounded-xl bg-white ring-1 ring-gray-100 shadow-sm">
            <dt class="text-xs text-gray-500">{{ __('home.stats_satisfaction') }}</dt>
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
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
