<?php

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

Route::get('/','web\Anwser@guest');

Route::get('/login',function(){
	return view('login/index');
});
Route::post('/login','web\login@login');

Route::middleware('login')->group(function(){

	Route::get('/home/{name?}','web\home@doIndex');

	Route::get('/score/{name?}','web\score@index');

	Route::get('/setting','web\setting@index');
	Route::post('/setting/count','web\setting@postCount');
	Route::post('/setting/other','web\setting@postOther');

	Route::get('/source/{name?}',function($name = 'index'){
		return view('source/index')->with('_name',$name);
	});

	Route::post('/home/add','web\home@doAdd');

});

Route::get('/imgcode','web\anwser@getVerifyCode');
Route::get('/guest','web\anwser@guest');
Route::post('/guest','web\anwser@guestLogin');

Route::middleware('student')->group(function(){

	Route::get('/anwser','web\anwser@index');
	Route::post('/anwser','web\anwser@post');

});
