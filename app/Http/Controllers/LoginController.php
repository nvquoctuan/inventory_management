<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Events\LoginUserEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Cookie;

class LoginController extends Controller
{
    public function create(){
    	return view('login');
    }

    public function loginUser(LoginRequest $request){
      $email = $request->input('email');
      $user = DB::table('users')->where('email', $email)->first();
    	session(['user' => $user->id]);

      if(!is_null($request->input('remember'))){
        $token = Str::random(30);
        DB::table('users')->where('email', $email)->update(['remember_token' => $token]);
        response('')->cookie('remember_token', $token, '7200');
      }
      return redirect()->route('dashboard')->with(['message' => 'Login success', 'type' => 'success']);
    }

   	public function logout(Request $request){
   		$request->session()->forget('user');
   		return redirect()->route('login')->with(['message' => 'Logout Success', 'type' => 'success']);
   	}
}
