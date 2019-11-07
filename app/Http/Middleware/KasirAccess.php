<?php

namespace App\Http\Middleware;

use App\Users;
use Closure;
use Illuminate\Support\Facades\Session;

class KasirAccess
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
        if (Session::get('level') == Users::KASIR) {
            return $next($request);
        }

        else {
            return redirect()->back()->with('access_err', 'Entri transaksi hanya bisa diakses kasir!');
        }
    }
}
