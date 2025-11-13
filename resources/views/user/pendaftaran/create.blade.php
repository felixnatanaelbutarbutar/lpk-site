{{-- resources/views/user/pendaftaran/create.blade.php --}}
@extends('layouts.user.layout')

@section('title', translateText('LPK MORI • Formulir Pendaftaran Siswa Baru'))
@section('page-title', translateText('Formulir Pendaftaran Siswa Baru'))
@section('page-description', translateText('Silakan lengkapi data di bawah ini dengan benar. Bidang bertanda * wajib diisi.'))

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Alert validasi global (opsional) --}}
    @if ($errors->any())
      <div class="mb-6 rounded-lg border-2 px-4 py-3 flex items-start gap-3 animate-fade-in"
           style="border-color:#f84e01; background-color:#fef2f2;">
        <svg class="w-5 h-5 shrink-0 mt-0.5" style="color:#f84e01;" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <div>
          <div class="font-semibold" style="color:#991b1b;">{{ translateText('Terjadi kesalahan!') }}</div>
          <ul class="mt-2 list-disc list-inside text-sm text-red-700">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl shadow-sm">
      <div class="px-5 md:px-8 py-5 border-b border-gray-200 dark:border-zinc-700">
        <div class="flex items-center gap-3">
          <div class="h-9 w-9 rounded-lg text-white grid place-items-center font-bold text-sm"
               style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
            1
          </div>
          <div>
            <h2 class="text-lg md:text-xl font-semibold" style="color:#0d7e84;">
              {{ translateText('Data Pendaftaran') }}
            </h2>
            <p class="text-xs text-gray-600 dark:text-gray-400">
              {{ translateText('Lengkapi semua bidang yang diperlukan') }}
            </p>
          </div>
        </div>
      </div>

      <form
        action="{{ route('pendaftaran.store', ['lang' => app()->getLocale()]) }}"
        method="POST"
        enctype="multipart/form-data"
        class="px-5 md:px-8 py-6 space-y-6"
        novalidate
      >
        @csrf

        {{-- Grid utama --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
          {{-- PROGRAM --}}
          <div class="md:col-span-2">
            <label for="program" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Program yang Dipilih') }} <span class="text-red-600">*</span>
            </label>
            <select id="program" name="program" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">
              <option value="">{{ translateText('-- Pilih Program --') }}</option>
              <option value="GINOU JISSHUUSEI" {{ old('program') == 'GINOU JISSHUUSEI' ? 'selected' : '' }}>
                {{ translateText('GINOU JISSHUUSEI') }}
              </option>
              <option value="TOKUTEI GINOU (MANDIRI)" {{ old('program') == 'TOKUTEI GINOU (MANDIRI)' ? 'selected' : '' }}>
                {{ translateText('TOKUTEI GINOU (MANDIRI)') }}
              </option>
            </select>
            @error('program')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Nama Lengkap --}}
          <div>
            <label for="nama_lengkap" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Nama Lengkap') }} <span class="text-red-600">*</span>
            </label>
            <input id="nama_lengkap" type="text" name="nama_lengkap" required
                   value="{{ old('nama_lengkap') }}"
                   autocomplete="name"
                   class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                          focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent"/>
            @error('nama_lengkap')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Tempat Lahir --}}
          <div>
            <label for="tempat_lahir" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Tempat Lahir') }} <span class="text-red-600">*</span>
            </label>
            <input id="tempat_lahir" type="text" name="tempat_lahir" required
                   value="{{ old('tempat_lahir') }}"
                   class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                          focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent"/>
            @error('tempat_lahir')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Tanggal Lahir --}}
          <div>
            <label for="tanggal_lahir" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Tanggal Lahir') }} <span class="text-red-600">*</span>
            </label>
            <input id="tanggal_lahir" type="date" name="tanggal_lahir" required
                   value="{{ old('tanggal_lahir') }}"
                   class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                          focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent"/>
            @error('tanggal_lahir')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Jenis Kelamin --}}
          <div>
            <label for="jenis_kelamin" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Jenis Kelamin') }} <span class="text-red-600">*</span>
            </label>
            <select id="jenis_kelamin" name="jenis_kelamin" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">
              <option value="">{{ translateText('-- Pilih --') }}</option>
              <option value="Laki-laki"  {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                {{ translateText('Laki-laki') }}
              </option>
              <option value="Perempuan"  {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                {{ translateText('Perempuan') }}
              </option>
            </select>
            @error('jenis_kelamin')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Pendidikan Terakhir --}}
          <div>
            <label for="pendidikan_terakhir" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Pendidikan Terakhir') }} <span class="text-red-600">*</span>
            </label>
            <select id="pendidikan_terakhir" name="pendidikan_terakhir" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">
              <option value="">{{ translateText('-- Pilih --') }}</option>
              @foreach(['SMA','SMK','D1','D2','D3','D4','S1'] as $edu)
                <option value="{{ $edu }}" {{ old('pendidikan_terakhir') == $edu ? 'selected' : '' }}>
                  {{ $edu }}
                </option>
              @endforeach
            </select>
            @error('pendidikan_terakhir')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Alamat KTP --}}
          <div class="md:col-span-2">
            <label for="alamat_ktp" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Alamat KTP') }} <span class="text-red-600">*</span>
            </label>
            <textarea id="alamat_ktp" name="alamat_ktp" rows="3" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">{{ old('alamat_ktp') }}</textarea>
            @error('alamat_ktp')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Pernah belajar bahasa Jepang? --}}
          <div>
            <label for="pernah_belajar_bahasa_jepang" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Pernah belajar bahasa Jepang?') }} <span class="text-red-600">*</span>
            </label>
            <select id="pernah_belajar_bahasa_jepang" name="pernah_belajar_bahasa_jepang" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">
              <option value="">{{ translateText('-- Pilih --') }}</option>
              <option value="Pernah" {{ old('pernah_belajar_bahasa_jepang') == 'Pernah' ? 'selected' : '' }}>
                {{ translateText('Pernah') }}
              </option>
              <option value="Tidak Pernah" {{ old('pernah_belajar_bahasa_jepang') == 'Tidak Pernah' ? 'selected' : '' }}>
                {{ translateText('Tidak Pernah') }}
              </option>
            </select>
            @error('pernah_belajar_bahasa_jepang')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Jika Pernah, di mana? (tampil kondisional) --}}
          <div id="wrap-tempat-belajar" class="{{ old('pernah_belajar_bahasa_jepang') === 'Pernah' ? '' : 'hidden' }}">
            <label for="tempat_belajar_bahasa" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Jika Pernah, di mana?') }}
            </label>
            <input id="tempat_belajar_bahasa" type="text" name="tempat_belajar_bahasa"
                   value="{{ old('tempat_belajar_bahasa') }}"
                   class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                          focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent"/>
            @error('tempat_belajar_bahasa')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Pernah ke Jepang? --}}
          <div>
            <label for="pernah_ke_jepang" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Pernah ke Jepang?') }} <span class="text-red-600">*</span>
            </label>
            <select id="pernah_ke_jepang" name="pernah_ke_jepang" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">
              <option value="">{{ translateText('-- Pilih --') }}</option>
              <option value="Pernah" {{ old('pernah_ke_jepang') == 'Pernah' ? 'selected' : '' }}>
                {{ translateText('Pernah') }}
              </option>
              <option value="Tidak Pernah" {{ old('pernah_ke_jepang') == 'Tidak Pernah' ? 'selected' : '' }}>
                {{ translateText('Tidak Pernah') }}
              </option>
            </select>
            @error('pernah_ke_jepang')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Tujuan ke Jepang --}}
          <div>
            <label for="tujuan_ke_jepang" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Tujuan ke Jepang') }} <span class="text-red-600">*</span>
            </label>
            <textarea id="tujuan_ke_jepang" name="tujuan_ke_jepang" rows="3" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">{{ old('tujuan_ke_jepang') }}</textarea>
            @error('tujuan_ke_jepang')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Sumber Informasi --}}
          <div>
            <label for="sumber_info" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Sumber Informasi') }} <span class="text-red-600">*</span>
            </label>
            <textarea id="sumber_info" name="sumber_info" rows="3" required
              class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                     focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent">{{ old('sumber_info') }}</textarea>
            @error('sumber_info')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Nomor WhatsApp --}}
          <div>
            <label for="nomor_whatsapp" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Nomor WhatsApp') }} <span class="text-red-600">*</span>
            </label>
            <input id="nomor_whatsapp" type="text" name="nomor_whatsapp" required
                   value="{{ old('nomor_whatsapp') }}"
                   placeholder="+62XXXXXXXXXXX"
                   inputmode="numeric"
                   class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                          focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent"/>
            @error('nomor_whatsapp')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Gunakan format Indonesia, contoh: +62812xxxxxxx') }}</p>
          </div>

          {{-- Upload Foto KTP --}}
          <div>
            <label for="foto_ktp" class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
              {{ translateText('Upload Foto KTP') }}
            </label>
            <input id="foto_ktp" type="file" name="foto_ktp" accept="image/*"
                   class="w-full rounded-lg border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100
                          file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:text-white
                          file:cursor-pointer
                          focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent"
                   style="--tw-ring-color:#0d7e84; --tw-shadow:0 0 #0000;
                          /* warna tombol file mengikuti brand */ 
                          --file-bg: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);"
            >
            <style>
              /* style tombol file untuk Tailwind file: pseudo */
              input[type="file"]::file-selector-button{
                background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);
              }
            </style>
            @error('foto_ktp')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">{{ translateText('Format JPG/PNG, maks. 2MB') }}</p>
          </div>
        </div>

        {{-- Actions --}}
        <div class="pt-2 flex items-center justify-end gap-3">
          <a href="{{ route('user.dashboard') }}"
             class="inline-flex items-center rounded-lg border border-gray-300 dark:border-zinc-700 px-4 py-2.5 text-sm font-medium
                    hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors">
            {{ translateText('Batal') }}
          </a>
          <button type="submit"
                  class="inline-flex items-center justify-center rounded-lg px-5 py-2.5 text-sm md:text-base font-semibold text-white
                         shadow-sm hover:opacity-90 transition-opacity"
                  style="background: linear-gradient(135deg, #f84e01 0%, #0d7e84 100%);">
            {{ translateText('Kirim Pendaftaran') }}
          </button>
        </div>
      </form>
    </div>

    {{-- Info footer kecil --}}
    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400 text-center">
      {{ translateText('Dengan mengirim formulir ini, Anda menyetujui kebijakan privasi LPK MORI CENTRE.') }}
    </p>
</div>
@endsection

@push('scripts')
<script>
  // Toggle field "Jika Pernah, di mana?" berdasar pilihan "Pernah belajar bahasa Jepang?"
  (function(){
    const select = document.getElementById('pernah_belajar_bahasa_jepang');
    const wrap   = document.getElementById('wrap-tempat-belajar');
    if(!select || !wrap) return;

    function update(){
      const show = select.value === 'Pernah';
      wrap.classList.toggle('hidden', !show);
      // Opsional: set required ketika tampil
      const input = document.getElementById('tempat_belajar_bahasa');
      if(input){
        if(show){ input.setAttribute('aria-hidden', 'false'); }
        else    { input.setAttribute('aria-hidden', 'true'); }
      }
    }

    select.addEventListener('change', update);
    update();
  })();
</script>
@endpush
