<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\SendResponse;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {

        $guards = empty($guards) ? [null] : $guards;
        $auth = SendResponse::determineAuth();

        switch ($auth) {
            case 'web':
                return $request->ajax() ? ['status' => true, 'href' => route('super.dashboard.index')] : Redirect::route('super.dashboard.index');
                break;
            case 'individu':

                return $request->ajax() ? ['status' => true, 'href' => route('individu.dashboard.index')] : Redirect::route('individu.dashboard.index');
                break;
            default:
        }
        return $next($request);
    }
}
