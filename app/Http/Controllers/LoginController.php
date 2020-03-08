<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Events\LoginUserEvent;

class LoginController extends Controller
{
    public function create(){
    	return view('login');
    }

    public function loginUser(LoginRequest $request){
      $user = DB::table('users')->where('email', $request->input('email'))->first();
    	session(['user' => $user->id]);

      if(!is_null($request->input('remember'))){
        event(new LoginUserEvent($user, $token));
      }

    	return redirect()->route('dashboard')->with(['message' => 'Login success', 'type' => 'success']);
    }

   	public function logout(Request $request){
   		$request->session()->forget('user');
   		return redirect()->route('login')->with(['message' => 'Logout Success', 'type' => 'success']);
   	}

}
