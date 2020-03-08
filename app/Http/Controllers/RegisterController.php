<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Mail\ActivationMail;
use App\Events\NewUserHasRegistedEvent;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create(){
    	return view('register');
    }

    /**
	 * Store the incoming blog post.
	 *
	 * @param  RegisterRequest  $request
	 * @return Response
	 */
    public function store(RegisterRequest $request){
    	$email = $request->input("email");
    	$name = $request->input("name");
    	$password = $request->input("password");
    	$token = Str::random(30);

    	$user = new User([
    		"email" => $email,
    		"name" => $name,
    		"password" => Hash::make($password),
    		"activate_digest" => Hash::make($token),
    	]);

    	$user->save();
    
    	event(new NewUserHasRegistedEvent($user, $token));

    	return redirect()->route('dashboard');
    }

    private function getUser($email){
    	return \App\User::where('email', $email)->first();
    }

    public function activeUser(Request $request, $token){
    	$user_id = $request->session()->get('user');
    	$activate_digest = DB::table('users')->where('id', $user_id)->value('activate_digest');
    	if(Hash::check($token, $activate_digest)){
    		$affected = DB::table('users')
              ->where('id', $user_id)
              ->update(['activate_digest' => "", "activated" => 1]);
            if($affected == 1){
            	return redirect()->route('dashboard')->with('message', 'Your account activated');
            }  
    	}
    	return redirect()->route('login')->with('message', 'Link active invalid
    		!');
    }
}
