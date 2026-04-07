<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSiswa
{
    public function handle(Request $request, Closure $next)
    {
        if (!\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::user()->role !== 'siswa') {
            return redirect('/login');
        }
        return $next($request);
    }
}
