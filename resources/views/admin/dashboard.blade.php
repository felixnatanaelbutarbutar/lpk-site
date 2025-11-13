@extends('layouts.admin.layout')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Selamat datang, {{ Auth::user()->name }}</h2>
    <p class="text-gray-600 dark:text-gray-300">Ini adalah halaman dashboard admin.</p>
</div>
@endsection
