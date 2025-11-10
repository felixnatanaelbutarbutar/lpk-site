<nav class="border-b bg-white/80 backdrop-blur sticky top-0 z-40" style="border-bottom: 2px solid #eaac59;">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      {{-- Brand --}}
      <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
        <img src="{{ asset('build/assets/images/logo.png') }}" alt="LPK MORI Logo" class="h-10 w-auto">
        <!-- <span class="font-bold text-lg hidden sm:inline" style="color: #0d7e84;">LPK MORI</span> -->
      </a>

      {{-- Desktop menu --}}
      <div class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="{{ url('/profile') }}" class="text-gray-700 hover:opacity-80 transition-opacity" style="hover:color: #0d7e84;">Profile</a>
        <a href="{{ url('/about') }}" class="text-gray-700 hover:opacity-80 transition-opacity">About Us</a>
        <a href="{{ url('/fasilitas') }}" class="text-gray-700 hover:opacity-80 transition-opacity">Fasilitas</a>
        <a href="{{ url('/program') }}" class="text-gray-700 hover:opacity-80 transition-opacity">Program</a>
        <a href="{{ url('/galeri') }}" class="text-gray-700 hover:opacity-80 transition-opacity">Galeri</a>
        <a href="{{ url('/contact') }}" class="text-gray-700 hover:opacity-80 transition-opacity">Contact Us</a>
        
        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-white hover:scale-105 transition-transform" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
          Pendaftaran Online
        </a>

        {{-- Language switcher --}}
        <div class="flex gap-2 items-center border-l pl-4" style="border-left-color: #eaac59;">
          <a href="{{ route('lang.switch', 'id') }}" class="px-2 py-1 rounded transition-all {{ app()->getLocale() == 'id' ? 'font-bold' : 'text-gray-600 hover:text-gray-900' }}" style="{{ app()->getLocale() == 'id' ? 'background-color: #43ca88; color: white;' : '' }}">🇮🇩</a>
          <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 rounded transition-all {{ app()->getLocale() == 'en' ? 'font-bold' : 'text-gray-600 hover:text-gray-900' }}" style="{{ app()->getLocale() == 'en' ? 'background-color: #43ca88; color: white;' : '' }}">🇺🇸</a>
          <a href="{{ route('lang.switch', 'jp') }}" class="px-2 py-1 rounded transition-all {{ app()->getLocale() == 'jp' ? 'font-bold' : 'text-gray-600 hover:text-gray-900' }}" style="{{ app()->getLocale() == 'jp' ? 'background-color: #43ca88; color: white;' : '' }}">🇯🇵</a>
        </div>

        {{-- Auth --}}
        @auth
        <div class="flex items-center gap-3 border-l pl-4" style="border-left-color: #eaac59;">
          <a href="{{ route('dashboard') }}" class="text-gray-700 hover:opacity-80 transition-opacity">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button class="hover:opacity-80 transition-opacity" style="color: #f84e01;">Logout</button>
          </form>
        </div>
        @else
        <div class="flex items-center gap-3 border-l pl-4" style="border-left-color: #eaac59;">
          <a href="{{ route('login') }}" class="text-gray-700 hover:opacity-80 transition-opacity">Login</a>
          <!-- <a href="{{ route('register') }}" class="px-3 py-1.5 rounded-lg hover:opacity-90 transition-opacity" style="background-color: #43ca88; color: white;">Register</a> -->
        </div>
        @endauth
      </div>

      {{-- Mobile hamburger --}}
      <button x-data @click="$refs.mobileMenu.classList.toggle('hidden')"
        class="md:hidden inline-flex items-center p-2 rounded-lg hover:bg-gray-100"
        aria-label="Open Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
          viewBox="0 0 24 24" stroke="currentColor" style="color: #0d7e84;">
          <path stroke-linecap="round"
            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  {{-- Mobile menu --}}
  <div x-ref="mobileMenu" class="md:hidden hidden border-t bg-white" style="border-top-color: #eaac59;">
    <div class="px-4 py-4 flex flex-col gap-3 text-sm">
      <a href="{{ url('/profile') }}" class="py-2 text-gray-700 hover:opacity-80 transition-opacity">Profile</a>
      <a href="{{ url('/about') }}" class="py-2 text-gray-700 hover:opacity-80 transition-opacity">About Us</a>
      <a href="{{ url('/fasilitas') }}" class="py-2 text-gray-700 hover:opacity-80 transition-opacity">Fasilitas</a>
      <a href="{{ url('/program') }}" class="py-2 text-gray-700 hover:opacity-80 transition-opacity">Program</a>
      <a href="{{ url('/galeri') }}" class="py-2 text-gray-700 hover:opacity-80 transition-opacity">Galeri</a>
      <a href="{{ url('/contact') }}" class="py-2 text-gray-700 hover:opacity-80 transition-opacity">Contact Us</a>
      
      <a href="{{ url('/pendaftaran') }}" class="px-4 py-3 rounded-lg text-white text-center font-medium w-full mt-2" style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
        Pendaftaran Online
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

      <div class="pt-3 mt-3 border-t" style="border-top-color: #eaac59;">
        @auth
        <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700 hover:opacity-80 transition-opacity">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
          @csrf
          <button class="text-left py-2 hover:opacity-80 transition-opacity" style="color: #f84e01;">Logout</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:opacity-80 transition-opacity">Login</a>
        <a href="{{ route('register') }}" class="block py-2 px-4 rounded-lg text-center font-medium mt-2" style="background-color: #43ca88; color: white;">Register</a>
        @endauth
      </div>
    </div>
  </div>
</nav>