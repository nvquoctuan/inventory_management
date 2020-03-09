<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class RedirectifLogin
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
        if($request->session()->has('user')){
            return redirect()->route('dashboard')->with(['message' => 'You are logged in', 'type' => 'warning']);
        }
        if(!empty(Cookie::get('remember_token'))){
            $user = DB::table('users')->where('remember_token', Cookie::get('remember_token'))->first();
            if(!empty($user)){
                session(['user' => $user->id]);
                return redirect()->route('dashboard')->with(['message' => 'You are logged in', 'type' => 'warning']);    
            }
        }

        return $next($request);
    }
}
