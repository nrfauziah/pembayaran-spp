<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (!empty(Auth::guard('petugas')->user()->id) && Auth::guard('petugas')->check()) {
            return redirect(RouteServiceProvider::HOMEPETUGAS);
        } else if (!empty(Auth::guard('siswa')->user()->id)&& Auth::guard('siswa')->check()) {
            return redirect(RouteServiceProvider::HOMESISWA);
        }

    return $next($request);
    }
}

