<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil kode bahasa dari session, default: 'id'
        $locale = session('locale', 'id');

        // Set bahasa aplikasi
        App::setLocale($locale);

        return $next($request);
    }
}
