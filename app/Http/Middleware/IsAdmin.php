<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login DAN role-nya adalah 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Lanjutkan ke halaman yang diminta
        }

        // Jika bukan admin atau belum login, arahkan ke halaman home
        return redirect('/')->with('error', 'Akses ditolak. Anda bukan Admin.');
    }
}