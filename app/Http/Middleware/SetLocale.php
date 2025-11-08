<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->query('lang', session('locale', 'id'));

        if (in_array($lang, ['id', 'en', 'ja'])) {
            App::setLocale($lang);
            session(['locale' => $lang]);
        }

        return $next($request);
    }
}