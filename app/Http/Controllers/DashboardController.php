<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    public function index(Request $request){
    	$user = $this->getUser($request);
    	return view('admin.dashboard', ['user' => $user]);
    }

    private function getUser(Request $request){
    	if(session()->has('user')){
    		$id_user = $request->session()->get('user');
    		return DB::table('users')->find($id_user);
    	}
    }
}
