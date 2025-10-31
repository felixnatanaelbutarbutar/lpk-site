<nav class="border-b bg-white/80 backdrop-blur sticky top-0 z-40">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-14 items-center justify-between">
      {{-- Brand --}}
      <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold text-lg">
        <span>LPK MORI</span>
      </a>

      {{-- Desktop menu --}}
      <div class="hidden md:flex items-center gap-6 text-sm">
        <a href="{{ url('/profile') }}" class="hover:text-indigo-600">Profile</a>
        <a href="{{ url('/about') }}" class="hover:text-indigo-600">About Us</a>
        <a href="{{ url('/fasilitas') }}" class="hover:text-indigo-600">Fasilitas</a>
        <a href="{{ url('/galeri') }}" class="hover:text-indigo-600">Galeri</a>
        <a href="{{ url('/contact') }}" class="hover:text-indigo-600">Contact Us</a>
        <a href="{{ url('/pendaftaran') }}" class="px-3 py-1.5 rounded bg-indigo-600 text-white hover:bg-indigo-700">
          Pendaftaran-online
        </a>

        {{-- Language switcher --}}
        <div class="flex items-center gap-2 ml-3 text-gray-500">
          <a class="hover:text-indigo-600" href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}">EN</a>
          <span>•</span>
          <a class="hover:text-indigo-600" href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}">ID</a>
          <span>•</span>
          <a class="hover:text-indigo-600" href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}">日本語</a>
        </div>

        {{-- Auth --}}
        @auth
          <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button class="hover:text-red-600">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="hover:text-indigo-600">Login</a>
          <a href="{{ route('register') }}" class="hover:text-indigo-600">Register</a>
        @endauth
      </div>

      {{-- Mobile hamburger --}}
      <button x-data @click="$refs.mobileMenu.classList.toggle('hidden')"
              class="md:hidden inline-flex items-center p-2 rounded hover:bg-gray-100"
              aria-label="Open Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round"
             stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </div>

  {{-- Mobile menu --}}
  <div x-ref="mobileMenu" class="md:hidden hidden border-t bg-white">
    <div class="px-4 py-3 flex flex-col gap-3 text-sm">
      <a href="{{ url('/profile') }}" class="hover:text-indigo-600">Profile</a>
      <a href="{{ url('/about') }}" class="hover:text-indigo-600">About Us</a>
      <a href="{{ url('/fasilitas') }}" class="hover:text-indigo-600">Fasilitas</a>
      <a href="{{ url('/galeri') }}" class="hover:text-indigo-600">Galeri</a>
      <a href="{{ url('/contact') }}" class="hover:text-indigo-600">Contact Us</a>
      <a href="{{ url('/pendaftaran') }}" class="px-3 py-2 rounded bg-indigo-600 text-white w-fit">Pendaftaran-online</a>

      <div class="flex items-center gap-3 pt-2 text-gray-500">
        <span>Language:</span>
        <a class="hover:text-indigo-600" href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}">EN</a>
        <a class="hover:text-indigo-600" href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}">ID</a>
        <a class="hover:text-indigo-600" href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}">日本語</a>
      </div>

      <div class="pt-2 border-t">
        @auth
          <a href="{{ route('dashboard') }}" class="block hover:text-indigo-600">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button class="text-left hover:text-red-600">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="block hover:text-indigo-600">Login</a>
          <a href="{{ route('register') }}" class="block hover:text-indigo-600">Register</a>
        @endauth
      </div>
    </div>
  </div>
</nav>
