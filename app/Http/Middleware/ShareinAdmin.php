<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use View;

class ShareinAdmin
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
        $id_user = $request->session()->get('user');
        $user = DB::table('users')->find($id_user);

        View::share('user', $user);
        return $next($request);
    }
}
