<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class AuthenticateUser
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
        $user = $this->getUser();
        if(empty($user)) return redirect()->route('login')->with(['message' => 'You not permission', 'type' => 'danger']);

        return $next($request);
    }

    private function getUser(){
        if(session('user')){
            return DB::table('users')->find(session('user'));
        }
        return "";
    }
}
