<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::get('logout','AuthController@getLogout');
Route::get('login',function(){
	return View::make('hello');
});

Route::get('forgotPassword',function(){
	return View::make('forgotPassword');
});

Route::get('auth','AuthController@index');    

Route::group(array('prefix' => 'auth'), function() {
 
	Route::post('/forgotPassword','AuthController@postForgotPassword');
	Route::get('/resetPassword','AuthController@getResetPassword');
	Route::post('/resetPassword','AuthController@postResetPassword');
        Route::post('/login','AuthController@postLogin');
	Route::post('/register','AuthController@postRegister');
	Route::get('/activate','AuthController@getActivate');

        });
