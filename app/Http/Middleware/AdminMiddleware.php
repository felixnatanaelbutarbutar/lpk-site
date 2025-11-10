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

        // Cek login
        if (!$user) {
            return redirect()->route('login');
        }

        // GANTI hasRole() → is_admin
        if (!$user->is_admin) {
            return response()->view('errors.403', [
                'message' => translateText('Akses ditolak. Anda bukan admin.')
            ], 403);
        }

        return $next($request);
    }
}