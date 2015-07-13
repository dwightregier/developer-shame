<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Registration routes...
Route::get('auth/register', ['as' => 'auth.getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'auth.postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('/', ['as' => 'home', function () {
    return view('home');
}]);

Route::get('/home', function () {
    return redirect()->route('home');
});