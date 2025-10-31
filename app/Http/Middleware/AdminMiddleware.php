<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Cek jika belum login
        if (!$user) {
            return redirect()->route('login');
        }

        // ✅ Cek role user
        if (!$user->hasRole('admin')) {
            // Bisa arahkan ke halaman lain atau kasih error 403
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
