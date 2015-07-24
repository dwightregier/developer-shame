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
    return redirect()->route('shames.featured');
}]);

Route::get('/home', function () {
    return redirect()->route('shames.featured');
});

// Shame routes...
Route::get('shames/featured', ['as' => 'shames.featured', 'uses' => 'ShameController@featuredShames']);
Route::get('shames/top', ['as' => 'shames.top', 'uses' => 'ShameController@topShames']);
Route::get('shames/new', ['as' => 'shames.new', 'uses' => 'ShameController@newShames']);
Route::get('shames/random', ['as' => 'shames.random', 'uses' => 'ShameController@randomShames']);
Route::post('shames/upvote', ['as' => 'shames.upvote', 'uses' => 'ShameController@upvote']);
Route::post('shames/follow', ['as' => 'shames.follow', 'uses' => 'ShameController@follow']);
Route::resource('shames', 'ShameController', ['only' => ['index', 'create', 'store', 'show']]);

// Comment routes...
Route::post('comments/upvote', ['as' => 'comments.upvote', 'uses' => 'CommentController@upvote']);
Route::resource('comments','CommentController', ['only' => ['index', 'store', 'edit', 'update', 'destroy']]);