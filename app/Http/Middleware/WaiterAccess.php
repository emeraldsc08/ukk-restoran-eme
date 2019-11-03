<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class WaiterAccess
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
        if (Session::get('level') == 2) {
            return $next($request);
        }

        else {
            return redirect()->back()->with('access_err', 'Entri pesanan hanya bisa diakses waiter!');
        }
    }
}
