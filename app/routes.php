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

Route::any('login/{provider?}/{callback?}',function(){
	try
	{
		Camelot::authenticate();

		if(Camelot::check()){
			echo 'Welcome'.Camelot::User()->first_name.' '.Camelot::User()->last_name.' you have been successfully logged in';
		}
	}
	catch(\Exception $e)
	{
			echo 'user could not be logged in';
	}
});