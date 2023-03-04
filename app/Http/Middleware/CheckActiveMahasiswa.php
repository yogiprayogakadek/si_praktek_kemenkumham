<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == 'Mahasiswa') {
            if(Auth::user()->mahasiswa->is_active != true) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akun anda sudah tidak aktif, mohon hubungi admin jika ada kendala');
            }
        }
        return $next($request);
    }
}
