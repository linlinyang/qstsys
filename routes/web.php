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
Route::post('/login','web\Login@login');

Route::middleware('login')->group(function(){

	Route::get('/home/{name?}','web\Home@doIndex');
	Route::post('/home/add','web\Home@doAdd');

	//Route::get('/score/{name?}','web\Score@index');

	Route::get('/setting','web\Setting@index');
	Route::post('/setting/count','web\Setting@postCount');
	Route::post('/setting/other','web\Setting@postOther');

	Route::get('/college','web\College@index');
	Route::get('/college/add',function(){
		return view('college/index')
    			->with('_name','insert');
	});
	Route::post('/college/add','web\College@insert');
	Route::get('/college/detail','web\College@detail');
	Route::post('/college/detail','web\College@detailUpdate');
	Route::get('/college/delete','web\College@delete');

});

Route::get('/imgcode','web\Anwser@getVerifyCode');
Route::get('/guest','web\Anwser@guest');
Route::post('/guest','web\Anwser@guestLogin');

Route::middleware('student')->group(function(){

	Route::get('/anwser','web\Anwser@index');
	Route::post('/anwser','web\Anwser@post');
	Route::get('/anwser/result','web\Anwser@result');

});
