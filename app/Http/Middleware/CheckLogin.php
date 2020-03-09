<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CheckLogin
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
        $email = $request->input('email');
        $user = DB::table('users')->where('email', $email)->first();
        if(empty($user)){
            return redirect()->route('login')->with(['message' => 'Email or pasasword wrong', 'type' => 'warning']);
        }
        if(!Hash::check($request->input('password'), $user->password)){
            return redirect()->route('login')->with(['message' => 'Email or pasasword wrong', 'type' => 'warning']);
        }
        if($user->activated != 1){
            return redirect()->route('login')->with(['message' => 'Account not active', 'type' => 'warning']);
        }

        return $next($request, $user);
    }

    public function terminate($request, $response){
        return redirect()->route('dashboard')->with(['message' => 'Login success', 'type' => 'success']);
    }
}
