<?php

namespace App\Http\Middleware\Akun;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class IndividuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!Auth::guard('individu')->check()) {
            return $request->ajax() ? ['status' => false, 'pesan' => 'Tidak Ada Akses', 403] : Redirect::back()->withErrors('Tidak Ada Akses');
        } else {

        }
        return $next($request);
    }
}
