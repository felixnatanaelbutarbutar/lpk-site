<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $available = ['en','id','ja'];
        $locale = $request->query('lang', session('lang', 'en'));
        if (! in_array($locale, $available)) {
            $locale = 'en';
        }
        App::setLocale($locale);
        session(['lang' => $locale]);
        return $next($request);
    }
}
