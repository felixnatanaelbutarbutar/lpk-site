<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'LPK MORI • User')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="min-h-screen bg-gray-100 text-gray-800 dark:bg-zinc-900 dark:text-zinc-100">

  {{-- TOP NAVBAR --}}
  <header class="sticky top-0 z-30 bg-white/80 dark:bg-zinc-900/80 backdrop-blur border-b border-gray-200 dark:border-zinc-800">
    <div class="max-w-7xl mx-auto h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      {{-- Logo + Title --}}
      <a href="{{ route('user.dashboard') }}" class="flex items-center gap-2">
        <div class="h-8 w-8 rounded-lg bg-indigo-600 text-white grid place-items-center font-bold">M</div>
        <span class="font-semibold text-lg">LPK MORI CENTRE</span>
      </a>

      {{-- Right Controls --}}
      <div class="flex items-center gap-3">
        <div class="text-xs text-gray-500">
            Debug: {{ app()->getLocale() }}
        </div>
        {{-- Language Switch --}}
        <div class="hidden sm:flex items-center gap-1">
            <a class="px-2 py-1 rounded text-xs hover:bg-gray-100 dark:hover:bg-zinc-800 {{ app()->getLocale()=='en'?'bg-gray-100 dark:bg-zinc-800':'' }}" 
               href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}">EN</a>
            <a class="px-2 py-1 rounded text-xs hover:bg-gray-100 dark:hover:bg-zinc-800 {{ app()->getLocale()=='id'?'bg-gray-100 dark:bg-zinc-800':'' }}" 
               href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}">ID</a>
            <a class="px-2 py-1 rounded text-xs hover:bg-gray-100 dark:hover:bg-zinc-800 {{ app()->getLocale()=='ja'?'bg-gray-100 dark:bg-zinc-800':'' }}" 
               href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}">日本語</a>
          </div>
          

        {{-- Theme Toggle --}}
        <button id="theme-toggle" class="p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
          <x-lucide-sun class="w-5 h-5 hidden dark:block" />
          <x-lucide-moon class="w-5 h-5 block dark:hidden" />
        </button>

        {{-- User Dropdown --}}
        <div class="relative group">
          <button class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
            <div class="h-8 w-8 rounded-lg bg-indigo-600 text-white grid place-items-center font-bold">
              {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <x-lucide-chevron-down class="w-4 h-4 opacity-60" />
          </button>
          <div class="absolute right-0 mt-2 w-48 rounded-lg border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-800">
              <x-lucide-user class="inline w-4 h-4 mr-2" /> Profil
            </a>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-800">
                <x-lucide-log-out class="inline w-4 h-4 mr-2" /> Logout
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- MAIN CONTENT --}}
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if (session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">
      {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3">
      {{ session('error') }}
    </div>
    @endif

    <h1 class="text-2xl font-bold mb-6">@yield('page-title')</h1>
    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="text-center text-xs text-gray-500 py-4 border-t border-gray-200 dark:border-zinc-800">
    © {{ date('Y') }} LPK MORI CENTRE. All rights reserved.
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
</body>
</html>
