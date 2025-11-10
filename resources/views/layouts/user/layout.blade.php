<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'LPK MORI • Dashboard Peserta')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <style>
    :root {
      --brand-orange: #f84e01;
      --brand-teal: #0d7e84;
      --brand-gold: #eaac59;
      --brand-green: #43ca88;
    }
  </style>
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 dark:bg-zinc-900 dark:text-zinc-100 transition-colors">

  {{-- TOP NAVBAR --}}
  <header class="sticky top-0 z-30 bg-white/90 dark:bg-zinc-800/90 backdrop-blur border-b-2" style="border-bottom-color: #eaac59;">
    <div class="max-w-7xl mx-auto h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      {{-- Logo + Title --}}
      <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
        <div class="h-10 w-10 rounded-lg text-white grid place-items-center font-bold text-lg" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
          M
        </div>
        <div class="hidden sm:block">
          <div class="font-bold text-lg" style="color: #0d7e84;">LPK MORI</div>
          <div class="text-xs text-gray-500">Portal Peserta</div>
        </div>
      </a>

      {{-- Right Controls --}}
      <div class="flex items-center gap-3">
        {{-- Language Switch --}}
        <div class="hidden sm:flex items-center gap-1 px-2 py-1 rounded-lg bg-gray-100 dark:bg-zinc-700">
          <a class="px-2 py-1 rounded text-xs font-medium transition-colors hover:bg-white dark:hover:bg-zinc-600 {{ app()->getLocale()=='en'?'bg-white dark:bg-zinc-600':'' }}" 
             href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}">🇺🇸</a>
          <a class="px-2 py-1 rounded text-xs font-medium transition-colors hover:bg-white dark:hover:bg-zinc-600 {{ app()->getLocale()=='id'?'bg-white dark:bg-zinc-600':'' }}" 
             href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}">🇮🇩</a>
          <a class="px-2 py-1 rounded text-xs font-medium transition-colors hover:bg-white dark:hover:bg-zinc-600 {{ app()->getLocale()=='ja'?'bg-white dark:bg-zinc-600':'' }}" 
             href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}">🇯🇵</a>
        </div>

        {{-- Theme Toggle --}}
        <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
          <svg class="w-5 h-5 hidden dark:block" style="color: #eaac59;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg class="w-5 h-5 block dark:hidden" style="color: #0d7e84;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        {{-- User Dropdown --}}
        <div class="relative group">
          <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
            <div class="h-9 w-9 rounded-lg text-white grid place-items-center font-bold text-sm" style="background: linear-gradient(135deg, #43ca88 0%, #0d7e84 100%);">
              {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="hidden md:block text-left text-sm">
              <div class="font-semibold leading-none mb-1">{{ Str::limit(auth()->user()->name, 15) }}</div>
              <div class="text-xs text-gray-500">Peserta</div>
            </div>
            <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          
          <div class="absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
            <div class="p-3 border-b border-gray-200 dark:border-zinc-700">
              <div class="font-semibold">{{ auth()->user()->name }}</div>
              <div class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</div>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
              <svg class="w-4 h-4" style="color: #0d7e84;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Edit Profil
            </a>
            
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
              <svg class="w-4 h-4" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Kembali ke Website
            </a>
            
            <div class="border-t border-gray-200 dark:border-zinc-700">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 text-left transition-colors">
                  <svg class="w-4 h-4" style="color: #f84e01;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- BREADCRUMB (Optional) --}}
  @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
  <div class="bg-white dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
      <nav class="flex items-center gap-2 text-sm">
        <a href="{{ route('user.dashboard') }}" class="hover:opacity-80 transition-opacity" style="color: #0d7e84;">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
          </svg>
        </a>
        @foreach($breadcrumbs as $breadcrumb)
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
          @if($loop->last)
            <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $breadcrumb['name'] }}</span>
          @else
            <a href="{{ $breadcrumb['url'] }}" class="text-gray-600 dark:text-gray-400 hover:opacity-80 transition-opacity">
              {{ $breadcrumb['name'] }}
            </a>
          @endif
        @endforeach
      </nav>
    </div>
  </div>
  @endif

  {{-- MAIN CONTENT --}}
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Flash Messages --}}
    @if (session('success'))
    <div class="mb-6 rounded-lg border-2 px-4 py-3 flex items-center gap-3 animate-fade-in" style="border-color: #43ca88; background-color: #f0fdf4;">
      <svg class="w-5 h-5 flex-shrink-0" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
      <span style="color: #166534;" class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if (session('error'))
    <div class="mb-6 rounded-lg border-2 px-4 py-3 flex items-center gap-3 animate-fade-in" style="border-color: #f84e01; background-color: #fef2f2;">
      <svg class="w-5 h-5 flex-shrink-0" style="color: #f84e01;" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
      </svg>
      <span style="color: #991b1b;" class="font-medium">{{ session('error') }}</span>
    </div>
    @endif

    @if (session('warning'))
    <div class="mb-6 rounded-lg border-2 px-4 py-3 flex items-center gap-3 animate-fade-in" style="border-color: #eaac59; background-color: #fffbeb;">
      <svg class="w-5 h-5 flex-shrink-0" style="color: #eaac59;" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
      </svg>
      <span style="color: #92400e;" class="font-medium">{{ session('warning') }}</span>
    </div>
    @endif

    {{-- Page Title --}}
    @if(isset($pageTitle) || View::hasSection('page-title'))
    <div class="mb-6">
      <h1 class="text-2xl md:text-3xl font-bold" style="color: #0d7e84;">
        @yield('page-title', $pageTitle ?? '')
      </h1>
      @if(isset($pageDescription) || View::hasSection('page-description'))
      <p class="mt-2 text-gray-600 dark:text-gray-400">
        @yield('page-description', $pageDescription ?? '')
      </p>
      @endif
    </div>
    @endif

    {{-- Content --}}
    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="bg-white dark:bg-zinc-800 border-t-2" style="border-top-color: #eaac59;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="text-center md:text-left">
          <div class="font-bold text-lg mb-1" style="color: #0d7e84;">LPK MORI CENTRE</div>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Lembaga Pelatihan Kerja Terpercaya untuk Karir di Jepang
          </p>
        </div>
        
        <div class="flex items-center gap-6 text-sm">
          <a href="{{ url('/contact') }}" class="hover:opacity-80 transition-opacity" style="color: #0d7e84;">
            Hubungi Kami
          </a>
          <a href="{{ url('/about') }}" class="hover:opacity-80 transition-opacity" style="color: #43ca88;">
            Tentang Kami
          </a>
          <a href="{{ url('/fasilitas') }}" class="hover:opacity-80 transition-opacity" style="color: #eaac59;">
            Fasilitas
          </a>
        </div>
      </div>
      
      <div class="mt-6 pt-6 border-t border-gray-200 dark:border-zinc-700 text-center text-xs text-gray-500">
        <p>© {{ date('Y') }} LPK MORI CENTRE. All rights reserved.</p>
        <p class="mt-1">Portal Peserta v1.0 • Dibuat dengan <span style="color: #f84e01;">♥</span></p>
      </div>
    </div>
  </footer>

  {{-- THEME SCRIPT --}}
  <script>
    const toggle = document.getElementById('theme-toggle');
    const root = document.documentElement;

    const applyTheme = (v) => {
      if (v === 'dark') root.classList.add('dark');
      else root.classList.remove('dark');
    };

    const saved = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    applyTheme(saved ?? (prefersDark ? 'dark' : 'light'));

    toggle.addEventListener('click', () => {
      const next = root.classList.contains('dark') ? 'light' : 'dark';
      applyTheme(next);
      localStorage.setItem('theme', next);
    });
  </script>

  @stack('scripts')
</body>
</html>