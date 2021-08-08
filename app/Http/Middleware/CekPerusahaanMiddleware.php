<?php

namespace App\Http\Middleware;

use Closure;

class CekPerusahaanMiddleware
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
        if (!session('perusahaan_id')) {
            return redirect('/perusahaan/login');
        }
        return $next($request);
    }
}
