<?php

namespace App\Http\Middleware;

use Closure;

class IsVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->is_active == 3){
            return $next($request);
        }

        return redirect()->back()->with('failed', 'Akun Anda Belum Terverifikasi, Untuk Melanjutkan Silakan Verifikasi Email Terlebih Dahulu');
        
    }
}
