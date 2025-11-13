<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'LPK MORI • Admin')</title>
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

  {{-- SIDEBAR --}}
  <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 transform transition-transform duration-300 -translate-x-full lg:translate-x-0 bg-white dark:bg-zinc-800 border-r border-gray-200 dark:border-zinc-700">
    {{-- Logo Section --}}
    <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200 dark:border-zinc-700" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-lg bg-white/20 backdrop-blur text-white grid place-items-center font-bold text-lg">
          M
        </div>
        <div>
          <div class="font-bold text-white text-lg">LPK MORI</div>
          <div class="text-xs text-white/80">Admin Panel</div>
        </div>
      </a>
      <button id="sidebar-close" class="lg:hidden p-2 rounded hover:bg-white/10 text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    {{-- Navigation --}}
    <nav class="p-4 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 64px);">
      {{-- Dashboard --}}
      <a href="{{ route('admin.dashboard') }}" 
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
        <svg class="w-5 h-5" style="color: #f84e01;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>

      {{-- Users --}}
      <a href="" 
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
        <svg class="w-5 h-5" style="color: #0d7e84;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span class="font-medium">Users</span>
      </a>

      {{-- Pendaftaran --}}
      <a href="{{ route('admin.pendaftaran.index') }}" 
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors {{ request()->routeIs('admin.pendaftaran.*') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
        <svg class="w-5 h-5" style="color: #eaac59;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="font-medium">Pendaftaran</span>
        @if(isset($pendingCount) && $pendingCount > 0)
        <span class="ml-auto px-2 py-0.5 text-xs font-bold rounded-full text-white" style="background-color: #f84e01;">
          {{ $pendingCount }}
        </span>
        @endif
      </a>

      {{-- Programs --}}
      <a href="{{ route('admin.fasilitas.index') }}"  
   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors 
          {{ request()->routeIs('admin.fasilitas.*') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
    <svg class="w-5 h-5" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
    </svg>
    <span class="font-medium">Fasilitas</span>
</a>
      <a href="{{ route('admin.galeri.index') }}"  
      class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors 
            {{ request()->routeIs('admin.galeri.*') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
      <svg class="w-5 h-5" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
      </svg>
      <span class="font-medium">Galeri</span>
      </a>

      {{-- Alumni --}}
      <a href="{{ route('admin.alumni.index') }}"   
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors {{ request()->routeIs('admin.alumni.*') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
        <svg class="w-5 h-5" style="color: #f84e01;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Alumni</span>
      </a>

      <div class="my-4 border-t border-gray-200 dark:border-zinc-700"></div>

      {{-- Settings --}}
      <a href="" 
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors {{ request()->routeIs('admin.settings') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
        <svg class="w-5 h-5" style="color: #0d7e84;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="font-medium">Settings</span>
      </a>

      {{-- Reports --}}
      <a href="" 
         class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors {{ request()->routeIs('admin.reports') ? 'bg-gray-100 dark:bg-zinc-700' : '' }}">
        <svg class="w-5 h-5" style="color: #eaac59;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="font-medium">Reports</span>
      </a>
    </nav>
  </aside>

  {{-- MAIN WRAPPER --}}
  <div class="lg:pl-64">
    {{-- TOP NAVBAR --}}
    <header class="sticky top-0 z-30 bg-white/80 dark:bg-zinc-800/80 backdrop-blur border-b border-gray-200 dark:border-zinc-700">
      <div class="h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        {{-- Mobile Menu Toggle --}}
        <button id="sidebar-open" class="lg:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

        {{-- Page Title (Optional) --}}
        <div class="flex-1 px-4">
          <h1 class="text-lg font-semibold hidden sm:block">@yield('page-title', 'Dashboard')</h1>
        </div>

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

          {{-- Notifications --}}
          <button class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
            <svg class="w-5 h-5" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-1 right-1 w-2 h-2 rounded-full" style="background-color: #f84e01;"></span>
          </button>

          {{-- User Dropdown --}}
          <div class="relative group">
            <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
              <div class="h-8 w-8 rounded-lg text-white grid place-items-center font-bold text-sm" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
              </div>
              <svg class="w-4 h-4 opacity-60 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            
            <div class="absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
              <div class="p-3 border-b border-gray-200 dark:border-zinc-700">
                <div class="font-semibold">{{ auth()->user()->name }}</div>
                <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
              </div>
              <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700">
                <svg class="w-4 h-4" style="color: #0d7e84;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profile Settings
              </a>
              <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700">
                <svg class="w-4 h-4" style="color: #43ca88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Visit Website
              </a>
              <div class="border-t border-gray-200 dark:border-zinc-700">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="w-full flex items-center gap-3 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700 text-left">
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

    {{-- MAIN CONTENT --}}
    <main class="p-4 sm:p-6 lg:p-8">
      {{-- Flash Messages --}}
      @if (session('success'))
      <div class="mb-6 rounded-lg border-2 px-4 py-3 flex items-center gap-3" style="border-color: #43ca88; background-color: #f0fdf4;">
        <svg class="w-5 h-5 flex-shrink-0" style="color: #43ca88;" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span style="color: #166534;">{{ session('success') }}</span>
      </div>
      @endif

      @if (session('error'))
      <div class="mb-6 rounded-lg border-2 px-4 py-3 flex items-center gap-3" style="border-color: #f84e01; background-color: #fef2f2;">
        <svg class="w-5 h-5 flex-shrink-0" style="color: #f84e01;" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        <span style="color: #991b1b;">{{ session('error') }}</span>
      </div>
      @endif

      @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="text-center text-xs text-gray-500 py-6 border-t border-gray-200 dark:border-zinc-700">
      <p>© {{ date('Y') }} LPK MORI CENTRE. All rights reserved.</p>
      <p class="mt-1">Admin Panel v1.0 • Made with <span style="color: #f84e01;">♥</span></p>
    </footer>
  </div>

  {{-- Sidebar Overlay --}}
  <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

  {{-- SCRIPTS --}}
  <script>
    // Theme Toggle
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

    // Mobile Sidebar Toggle
    const sidebar = document.getElementById('sidebar');
    const sidebarOpen = document.getElementById('sidebar-open');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    const openSidebar = () => {
      sidebar.classList.remove('-translate-x-full');
      sidebarOverlay.classList.remove('hidden');
    };

    const closeSidebar = () => {
      sidebar.classList.add('-translate-x-full');
      sidebarOverlay.classList.add('hidden');
    };

    sidebarOpen.addEventListener('click', openSidebar);
    sidebarClose.addEventListener('click', closeSidebar);
    sidebarOverlay.addEventListener('click', closeSidebar);
  </script>
  <script src="https://unpkg.com/lucide@latest"></script>
  @stack('scripts')
</body>
</html>