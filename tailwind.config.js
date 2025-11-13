import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  // Penting untuk toggle tema manual:
  darkMode: 'class',

  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    // Tambahan agar Tailwind juga memindai class di file JS/Vue:
    './resources/js/**/*.js',
    './resources/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      // Opsional tapi disarankan: aktifkan animate-fade-in yang dipakai di layout
      keyframes: {
        'fade-in': { '0%': { opacity: 0 }, '100%': { opacity: 1 } },
      },
      animation: {
        'fade-in': 'fade-in 200ms ease-out',
      },
    },
  },

  plugins: [forms],
}
