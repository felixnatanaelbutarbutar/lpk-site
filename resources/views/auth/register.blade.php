<x-guest-layout>
    {{-- Container di guest-layout seharusnya sudah mengatur lebar form --}}

    {{-- Language switcher (default EN) --}}
    <div class="mb-4 flex gap-3 justify-end text-sm text-gray-500">
        <a href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}" class="hover:text-gray-900 transition-colors">EN</a>
        <a href="{{ request()->fullUrlWithQuery(['lang'=>'id']) }}" class="hover:text-gray-900 transition-colors">ID</a>
        <a href="{{ request()->fullUrlWithQuery(['lang'=>'ja']) }}" class="hover:text-gray-900 transition-colors">日本語</a>
    </div>

    {{-- JUDUL FORM --}}
    <h2 class="text-3xl font-bold mb-8 text-center" style="color: #0d7e84;">
        {{ __('Daftar Akun Baru') }}
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-[#0d7e84] focus:ring-[#0d7e84]/50"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#0d7e84] focus:ring-[#0d7e84]/50"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#0d7e84] focus:ring-[#0d7e84]/50"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-[#0d7e84] focus:ring-[#0d7e84]/50"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Footer & Button --}}
        <div class="flex items-center justify-between mt-8">
            <a class="underline text-sm text-gray-600 hover:text-[#0d7e84] transition-colors"
               href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>
            
            {{-- Button Dibuat gradient sesuai style navbar --}}
            <button class="px-6 py-2 rounded-lg text-white font-semibold shadow-lg hover:scale-[1.02] transition-transform duration-200"
                style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
                {{ __('Daftar') }}
            </button>
        </div>
    </form>
</x-guest-layout>