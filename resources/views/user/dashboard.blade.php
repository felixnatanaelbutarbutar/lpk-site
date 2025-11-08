@extends('layouts.user.layout')

@section('title', 'Dashboard User')
@section('page-title', 'Dashboard')

@section('content')
  <p class="text-gray-600 dark:text-zinc-400 mb-6">
    Selamat datang, {{ auth()->user()->name }}! Pilih menu di bawah untuk melanjutkan.
  </p>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    {{-- Menu: Data Pendaftaran --}}
    <a href="{{ route('pendaftaran.index') }}" 
       class="group p-6 rounded-2xl border border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-sm hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="text-lg font-semibold mb-1 group-hover:text-indigo-600 transition">Data Pendaftaran</h3>
          <p class="text-sm text-gray-500 dark:text-zinc-400">Lihat dan kelola data pendaftaran Anda</p>
        </div>
        <x-lucide-file-text class="w-8 h-8 text-indigo-500 opacity-80" />
      </div>
    </a>
  </div>
@endsection
