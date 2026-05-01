<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user di database sama dengan $role yang diminta di route
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, kembalikan ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['role' => 'Anda tidak memiliki akses ke halaman ini.']);
    }
}