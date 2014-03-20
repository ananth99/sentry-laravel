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

Route::post('auth/login','AuthController@postLogin');
Route::post('auth/register','AuthController@postRegister');
Route::get('auth/activate','AuthController@getActivate');
Route::get('auth','AuthController@index');
Route::get('logout','AuthController@getLogout');
Route::get('login',function(){
	return View::make('hello');
});

Route::get('forgotPassword',function(){
	return View::make('forgotPassword');
});

Route::post('auth/forgotPassword','AuthController@postForgotPassword');
Route::get('auth/resetPassword','AuthController@getResetPassword');
Route::post('auth/resetPassword','AuthController@postResetPassword');

