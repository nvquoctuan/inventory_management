<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['logged'])->group(function(){
	Route::get('/', function(){
		return view('welcome');
	});
	Route::get('/login', 'LoginController@create')->name('login');
	Route::post('/login', 'LoginController@loginUser')->name('login_user')->middleware('login');

	Route::get('/register', 'RegisterController@create')->name('register');
	Route::post('/register', 'RegisterController@store');	
});
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/user/active/{email}/{token?}', 'RegisterController@activeUser');
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth_user', 'shared_admin'])->group(function(){
	Route::get('/dashboard', "DashboardController@index")->name('dashboard');
	Route::resource('/user', 'UserController');
	Route::put('/user/update_role/{id}', "UserController@updateRole");
});
