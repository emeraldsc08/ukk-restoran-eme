<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ExceptAdminAccess
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
        if (Session::get('level') == 1) {
            return redirect()->back()->with('access_err', 'Generate laporan hanya bisa diakses non-admin!');
        }

        else {
            return $next($request);
        }
    }
}
