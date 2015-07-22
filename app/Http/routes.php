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

// Authentication routes...
Route::get('/login', ['as' => 'auth.getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'auth.postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'auth.getLogout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::post('/register', ['as' => 'auth.postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('/', ['as' => 'home', function () {
    return view('home');
}]);

Route::get('/home', function () {
    return redirect()->route('home');
});

// Resource routes...
Route::resource('shame', 'ShameController', ['only' => ['create', 'store']]);