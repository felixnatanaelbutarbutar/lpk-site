<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex bg-gray-100 dark:bg-zinc-900 text-gray-800 dark:text-white min-h-screen">

    {{-- Sidebar --}}
    <aside id="sidebar" class="w-64 bg-white dark:bg-zinc-800 shadow-lg min-h-screen hidden md:block fixed md:relative z-50">
        <div class="p-5 border-b border-gray-200 dark:border-zinc-700">
            <h2 class="text-xl font-bold text-blue-600">Kemahasiswaan</h2>
            <p class="text-xs text-gray-500">Institut Teknologi Del</p>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-2 rounded-lg transition-all duration-200
                      hover:bg-blue-100 dark:hover:bg-zinc-700
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white shadow-md' : 'text-gray-700 dark:text-gray-300' }}">
                <x-lucide-layout-dashboard class="w-5 h-5 mr-2"/>
                Dashboard
            </a>

            {{-- <a href="{{ route('admin.programs.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition-all duration-200
                      hover:bg-blue-100 dark:hover:bg-zinc-700
                      {{ request()->routeIs('admin.programs.*') ? 'bg-blue-500 text-white shadow-md' : 'text-gray-700 dark:text-gray-300' }}">
                <x-lucide-book-open class="w-5 h-5 mr-2"/>
                Program Pelatihan
            </a> --}}
        </nav>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col min-h-screen md:ml-64">

        {{-- Navbar --}}
        <header class="bg-white/90 dark:bg-zinc-800/90 backdrop-blur-sm shadow-sm flex items-center justify-between p-4 sticky top-0 z-40">
            <div class="flex items-center space-x-3">
                <button class="md:hidden text-gray-600 dark:text-gray-300" id="menu-toggle">
                    <x-lucide-menu class="w-6 h-6"/>
                </button>
                <h1 class="font-semibold text-gray-800 dark:text-white">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="flex items-center space-x-4">
                {{-- Tombol Theme --}}
                <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition">
                    <x-lucide-sun class="w-5 h-5 hidden dark:block"/>
                    <x-lucide-moon class="w-5 h-5 block dark:hidden"/>
                </button>

                {{-- User Dropdown --}}
                <div class="relative group">
                    <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition">
                        <div class="w-8 h-8 bg-blue-500 text-white rounded-lg flex items-center justify-center font-semibold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="hidden md:inline text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <x-lucide-chevron-down class="w-4 h-4 opacity-60"/>
                    </button>

                    <div class="absolute right-0 mt-2 w-52 bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-100 dark:border-zinc-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="p-3 border-b dark:border-zinc-700">
                            <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-zinc-700">
                                <x-lucide-log-out class="inline w-4 h-4 mr-2"/> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Halaman utama --}}
        <main class="flex-1 p-8 bg-gray-100 dark:bg-zinc-900">
            @yield('content')
        </main>
    </div>

    {{-- Script Responsif & Theme --}}
    <script>
        // Sidebar toggle (mobile)
        const sidebar = document.getElementById('sidebar');
        document.getElementById('menu-toggle').addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
        });
    </script>

</body>
</html>
