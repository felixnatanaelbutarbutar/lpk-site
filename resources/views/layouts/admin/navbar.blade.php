<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'LPK MORI • Admin')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <style>
    /* smooth scrollbar dark */
    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: #c7c7c7;
      border-radius: 8px;
    }
    .dark ::-webkit-scrollbar-thumb {
      background-color: #3f3f46;
    }
  </style>
</head>
<body class="min-h-screen bg-gray-100 text-gray-800 dark:bg-zinc-900 dark:text-zinc-100">
  {{-- Off-canvas backdrop (mobile) --}}
  <div id="backdrop" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden"></div>
  
  <div class="flex min-h-screen">
    {{-- SIDEBAR --}}
    <aside id="sidebar"
      class="fixed inset-y-0 left-0 z-50
             w-72 md:w-64 -translate-x-full md:translate-x-0
             bg-white dark:bg-zinc-900 border-r border-gray-200 dark:border-zinc-800
             transition-transform duration-200
             flex flex-col">
      
      {{-- Header Sidebar --}}
      <div class="h-16 px-5 flex items-center justify-between border-b border-gray-200 dark:border-zinc-800 flex-shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
          <div class="h-8 w-8 rounded-lg bg-indigo-600 text-white grid place-items-center font-bold">M</div>
          <div>
            <div class="text-sm tracking-widest uppercase text-gray-400">LPK MORI</div>
            <div class="font-semibold">Admin Panel</div>
          </div>
        </a>
        <button id="sidebar-close" class="md:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
          <x-lucide-x class="w-5 h-5" />
        </button>
      </div>

      {{-- Navigation Menu --}}
      @php
        $is = fn($name) => request()->routeIs($name) ? 'bg-indigo-600 text-white' : 'text-gray-700 dark:text-zinc-300 hover:bg-gray-100 dark:hover:bg-zinc-800';
        $ia = fn($name) => request()->routeIs($name) ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-gray-700 dark:text-zinc-300 hover:bg-gray-100 dark:hover:bg-zinc-800';
      @endphp
      
      <nav class="flex-1 overflow-y-auto p-4 space-y-1 text-sm">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $is('admin.dashboard') }}">
          <x-lucide-layout-dashboard class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Dashboard</span>
        </a>
        
        <div class="mt-3 mb-1 px-3 text-[11px] uppercase tracking-wider text-gray-400">Admissions</div>
        <a href="{{ route('admin.registrations.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.registrations.*') }}">
          <x-lucide-file-check-2 class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Pendaftaran</span>
        </a>
        
        <div class="mt-3 mb-1 px-3 text-[11px] uppercase tracking-wider text-gray-400">Content</div>
        <a href="{{ route('admin.facilities.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.facilities.*') }}">
          <x-lucide-building-2 class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Fasilitas</span>
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.gallery.*') }}">
          <x-lucide-images class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Galeri</span>
        </a>
        <a href="{{ route('admin.alumni.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.alumni.*') }}">
          <x-lucide-users-round class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Alumni</span>
        </a>
        <a href="{{ route('admin.programs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.programs.*') }}">
          <x-lucide-book-open class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Program</span>
        </a>
        
        <div class="mt-3 mb-1 px-3 text-[11px] uppercase tracking-wider text-gray-400">System</div>
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.users.*') }}">
          <x-lucide-user-cog class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Users & Roles</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ $ia('admin.settings.*') }}">
          <x-lucide-settings-2 class="w-5 h-5 flex-shrink-0" /> 
          <span class="nav-label">Settings</span>
        </a>
      </nav>

      {{-- Footer Sidebar --}}
      <div class="flex-shrink-0 p-4 border-t border-gray-200 dark:border-zinc-800 text-xs text-gray-500">
        <div class="flex items-center justify-between">
          <span>v1.0</span>
          <span>© {{ date('Y') }} LPK MORI</span>
        </div>
      </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div id="main" class="flex-1 md:ml-64 min-h-screen flex flex-col">
      {{-- TOPBAR --}}
      <header class="sticky top-0 z-30 bg-white/80 dark:bg-zinc-900/80 backdrop-blur border-b border-gray-200 dark:border-zinc-800 flex-shrink-0">
        <div class="h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <button id="sidebar-open" class="md:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
              <x-lucide-menu class="w-6 h-6" />
            </button>
            <button id="sidebar-collapse" class="hidden md:inline-flex p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800" title="Collapse">
              <x-lucide-chevrons-left class="w-5 h-5" />
            </button>
            <div class="text-sm text-gray-500 dark:text-zinc-400">
              @yield('breadcrumbs')
            </div>
          </div>
          <div class="flex items-center gap-2">
            <form class="hidden md:block">
              <label class="relative block">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                  <x-lucide-search class="w-4 h-4 text-gray-400" />
                </span>
                <input type="search" name="q" placeholder="Search…" 
                  class="w-72 pl-9 pr-3 py-2 rounded-lg bg-gray-100 dark:bg-zinc-800 border border-transparent focus:border-indigo-300 focus:outline-none" />
              </label>
            </form>
            <div class="hidden sm:flex items-center gap-1 ml-2">
              <a class="px-2 py-1 rounded text-xs hover:bg-gray-100 dark:hover:bg-zinc-800 {{ app()->getLocale()=='en'?'bg-gray-100 dark:bg-zinc-800':'' }}" 
                href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}">EN</a>
              <a class="px-2 py-1 rounded text-xs hover:bg-gray-100 dark:hover:bg-zinc-800 {{ app()->getLocale()=='id'?'bg-gray-100 dark:bg-zinc-800':'' }}" 
                href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}">ID</a>
              <a class="px-2 py-1 rounded text-xs hover:bg-gray-100 dark:hover:bg-zinc-800 {{ app()->getLocale()=='ja'?'bg-gray-100 dark:bg-zinc-800':'' }}" 
                href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}">日本語</a>
            </div>
            <button id="theme-toggle" class="p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
              <x-lucide-sun class="w-5 h-5 hidden dark:block" />
              <x-lucide-moon class="w-5 h-5 block dark:hidden" />
            </button>
            <button class="relative p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
              <x-lucide-bell class="w-5 h-5" />
              <span class="absolute -top-0.5 -right-0.5 h-2 w-2 bg-rose-500 rounded-full"></span>
            </button>
            <div class="relative group">
              <button class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 dark:hover:bg-zinc-800">
                <div class="h-8 w-8 rounded-lg bg-indigo-600 text-white grid place-items-center font-bold">
                  {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <span class="hidden md:inline text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                <x-lucide-chevron-down class="w-4 h-4 opacity-60" />
              </button>
              <div class="absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition">
                <div class="p-3 border-b border-gray-200 dark:border-zinc-800">
                  <div class="text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
                  <div class="text-xs text-gray-500">{{ auth()->user()->email ?? '' }}</div>
                </div>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-800">
                  <x-lucide-user class="inline w-4 h-4 mr-2" /> Profile
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

      {{-- CONTENT WRAPPER --}}
      <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
        @hasSection('page-title')
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div>
            <h1 class="text-2xl md:text-3xl font-bold">@yield('page-title')</h1>
            @hasSection('page-subtitle')
            <p class="mt-1 text-sm text-gray-500 dark:text-zinc-400">@yield('page-subtitle')</p>
            @endif
          </div>
          <div class="flex items-center gap-2">
            @yield('page-actions')
          </div>
        </div>
        @endif
        
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
        
        @yield('content')
      </main>
    </div>
  </div>

  <script>
    // Elemen
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('backdrop');
    const openBtn = document.getElementById('sidebar-open');
    const closeBtn = document.getElementById('sidebar-close');
    const collapseBtn = document.getElementById('sidebar-collapse');
    const main = document.getElementById('main');

    // ---- MOBILE: open/close (geser masuk/keluar)
    const openSidebar = () => {
      sidebar.classList.remove('-translate-x-full');
      backdrop.classList.remove('hidden');
    };
    
    const closeSidebar = () => {
      sidebar.classList.add('-translate-x-full');
      backdrop.classList.add('hidden');
    };

    if (openBtn) openBtn.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (backdrop) backdrop.addEventListener('click', closeSidebar);

    // ---- DESKTOP: collapse ke ikon (w-16) / expand (w-64)
    let collapsed = localStorage.getItem('sidebar-collapsed') === 'true';
    
    const setCollapsed = (on) => {
      collapsed = on;
      localStorage.setItem('sidebar-collapsed', collapsed);
      
      sidebar.classList.toggle('md:w-16', collapsed);
      sidebar.classList.toggle('md:w-64', !collapsed);
      main.classList.toggle('md:ml-16', collapsed);
      main.classList.toggle('md:ml-64', !collapsed);
      
      document.querySelectorAll('#sidebar .nav-label').forEach(el => {
        el.classList.toggle('md:hidden', collapsed);
      });
      
      // Rotate icon
      if (collapseBtn) {
        const icon = collapseBtn.querySelector('svg');
        if (icon) {
          icon.style.transform = collapsed ? 'rotate(180deg)' : 'rotate(0deg)';
        }
      }
    };

    // Apply saved state on load
    if (collapsed) {
      setCollapsed(true);
    }

    if (collapseBtn) {
      collapseBtn.addEventListener('click', () => setCollapsed(!collapsed));
    }

    // ---- THEME (persist)
    const toggle = document.getElementById('theme-toggle');
    const root = document.documentElement;
    
    const applyTheme = (v) => {
      if (v === 'dark') {
        root.classList.add('dark');
      } else {
        root.classList.remove('dark');
      }
    };
    
    const saved = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    applyTheme(saved ?? (prefersDark ? 'dark' : 'light'));
    
    if (toggle) {
      toggle.addEventListener('click', () => {
        const next = root.classList.contains('dark') ? 'light' : 'dark';
        applyTheme(next);
        localStorage.setItem('theme', next);
      });
    }
  </script>
</body>
</html>