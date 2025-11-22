<nav class="border-b bg-white/80 backdrop-blur sticky top-0 z-40" style="border-bottom: 2px solid #eaac59;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      {{-- Brand --}}
      <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
        <img src="{{ asset('build/assets/images/logo.png') }}" alt="LPK MORI Logo" class="h-10 w-auto">
      </a>

      {{-- Desktop Menu --}}
      <div class="hidden md:flex items-center gap-6 text-sm font-medium">

        <a href="{{ route('profile') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
          {{ translateText('Profil Lembaga') }}
        </a>
        <a href="{{ url('/about') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
          {{ translateText('Tentang Kami') }}
        </a>
        <a href="{{ url('/fasilitas') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
          {{ translateText('Fasilitas') }}
        </a>
        <a href="{{ url('/program') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
          {{ translateText('Program') }}
        </a>
        <a href="{{ url('/galeri') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
          {{ translateText('Galeri') }}
        </a>
        <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
          {{ translateText('Hubungi Kami') }}
        </a>

        {{-- Tombol Pendaftaran --}}
        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-lg text-white font-medium hover:scale-105 transition-transform shadow-lg"
           style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
          {{ translateText('Pendaftaran Online') }}
        </a>

        <div class="hidden sm:flex items-center gap-1 px-2 py-1 rounded-lg bg-gray-100 dark:bg-zinc-700">
          <a class="px-2 py-1 rounded text-xs font-medium transition-colors hover:bg-white dark:hover:bg-zinc-600 {{ app()->getLocale()=='en'?'bg-white dark:bg-zinc-600':'' }}" 
             href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}">🇺🇸</a>
          <a class="px-2 py-1 rounded text-xs font-medium transition-colors hover:bg-white dark:hover:bg-zinc-600 {{ app()->getLocale()=='id'?'bg-white dark:bg-zinc-600':'' }}" 
             href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}">🇮🇩</a>
          <a class="px-2 py-1 rounded text-xs font-medium transition-colors hover:bg-white dark:hover:bg-zinc-600 {{ app()->getLocale()=='ja'?'bg-white dark:bg-zinc-600':'' }}" 
             href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}">🇯🇵</a>
        </div>
        {{-- Auth Links --}}
        @auth
          <div class="flex items-center gap-4 border-l pl-5 ml-4" style="border-left-color: #eaac59;">
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
              {{ translateText('Dashboard') }}
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="text-orange-600 hover:text-orange-700 font-medium transition-colors">
                {{ translateText('Logout') }}
              </button>
            </form>
          </div>
        @else
          <div class="flex items-center gap-4 border-l pl-5 ml-4" style="border-left-color: #eaac59;">
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-teal-700 transition-colors">
              {{ translateText('Login') }}
            </a>
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-green-500 text-white font-medium hover:bg-green-600 transition-colors">
              {{ translateText('Register') }}
            </a>
          </div>
        @endauth
      </div>

      {{-- Mobile Hamburger --}}
      <button x-data @click="$refs.mobileMenu.classList.toggle('hidden')"
              class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
              aria-label="Open Menu">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #0d7e84;">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div x-ref="mobileMenu" class="md:hidden hidden border-t bg-white" style="border-top-color: #eaac59;">
    <div class="px-4 py-5 space-y-4 text-sm">

      <a href="{{ route('profile') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Profil Lembaga') }}</a>
      <a href="{{ url('/about') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Tentang Kami') }}</a>
      <a href="{{ url('/fasilitas') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Fasilitas') }}</a>
      <a href="{{ url('/program') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Program') }}</a>
      <a href="{{ url('/galeri') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Galeri') }}</a>
      <a href="{{ url('/contact') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Hubungi Kami') }}</a>

      <a href="{{ route('register') }}" class="block text-center py-3 mt-3 rounded-lg text-white font-medium"
         style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
        {{ translateText('Pendaftaran Online') }}
      </a>

      <div class="pt-3 mt-3 border-t" style="border-top-color: #eaac59;">
        <p class="text-gray-500 text-xs mb-2">Language:</p>
        <div class="flex items-center gap-2">
          <a class="px-3 py-1.5 rounded transition-all {{ app()->getLocale() == 'id' ? 'font-bold' : 'text-gray-600' }}" 
             style="{{ app()->getLocale() == 'id' ? 'background-color: #43ca88; color: white;' : '' }}"
             href="{{ route('lang.switch', 'id') }}">🇮🇩 ID</a>
          <a class="px-3 py-1.5 rounded transition-all {{ app()->getLocale() == 'en' ? 'font-bold' : 'text-gray-600' }}" 
             style="{{ app()->getLocale() == 'en' ? 'background-color: #43ca88; color: white;' : '' }}"
             href="{{ route('lang.switch', 'en') }}">🇺🇸 EN</a>
          <a class="px-3 py-1.5 rounded transition-all {{ app()->getLocale() == 'jp' ? 'font-bold' : 'text-gray-600' }}" 
             style="{{ app()->getLocale() == 'jp' ? 'background-color: #43ca88; color: white;' : '' }}"
             href="{{ route('lang.switch', 'jp') }}">🇯🇵 JP</a>
        </div>
      </div>

      {{-- Auth Mobile --}}
      <div class="pt-4 border-t" style="border-top-color: #eaac59;">
        @auth
          <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Dashboard') }}</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left py-2 text-orange-600 hover:text-orange-700 font-medium">
              {{ translateText('Logout') }}
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-teal-700">{{ translateText('Login') }}</a>
          <a href="{{ route('register') }}" class="block text-center py-3 mt-2 rounded-lg bg-green-500 text-white font-medium hover:bg-green-600">
            {{ translateText('Register') }}
          </a>
        @endauth
      </div>
    </div>
  </div>
</nav>