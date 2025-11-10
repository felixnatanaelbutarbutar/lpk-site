<footer class="mt-10 border-t border-slate-200 dark:border-slate-800 pt-8 pb-6 bg-white dark:bg-slate-900">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-2">
                <img src="{{ asset('build/assets/images/logo.png') }}" alt="LPK MORI Logo" class="h-10 w-auto">
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-400">Lembaga pelatihan kerja ke Jepang terpercaya.</p>
        </div>

        <div class="flex flex-col gap-3">
            <h3 class="font-semibold text-slate-900 dark:text-slate-100">Navigasi</h3>
            <a href="{{ url('/profile') }}" class="text-sm text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">Profile</a>
            <a href="{{ url('/about') }}" class="text-sm text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">About Us</a>
            <a href="{{ url('/fasilitas') }}" class="text-sm text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">Fasilitas</a>
            <a href="{{ url('/galeri') }}" class="text-sm text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">Galeri</a>
            <a href="{{ url('/contact') }}" class="text-sm text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">Contact Us</a>
            <a href="{{ url('/pendaftaran') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Pendaftaran Online</a>
        </div>

        <div class="flex flex-col gap-3">
            <h3 class="font-semibold text-slate-900 dark:text-slate-100">Kontak</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Jl. Pelatihan No. 123, Jakarta</p>
            <p class="text-sm text-slate-600 dark:text-slate-400">info@lpkmori.com</p>
            <p class="text-sm text-slate-600 dark:text-slate-400">(021) 123-4567</p>
        </div>

        <div class="flex flex-col gap-3">
            <h3 class="font-semibold text-slate-900 dark:text-slate-100">Bahasa & Media Sosial</h3>
            <div class="flex gap-3 text-sm">
                <a href="{{ route('lang.switch', 'id') }}" class="{{ app()->getLocale()=='id' ? 'font-bold text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">🇮🇩 ID</a>
                <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale()=='en' ? 'font-bold text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">🇺🇸 EN</a>
                <a href="{{ route('lang.switch', 'jp') }}" class="{{ app()->getLocale()=='jp' ? 'font-bold text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">🇯🇵 JP</a>
            </div>
            <div class="flex gap-4 mt-2">
                <a href="#" class="text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path clip-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" class="text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
                <a href="#" class="text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path clip-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.802 2.013 10.156 2 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm6.406-11.845a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z" fill-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center text-sm text-slate-500 dark:text-slate-400">
        <p>© 2025 LPK Mori. All rights reserved.</p>
    </div>
</footer>