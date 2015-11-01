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

Route::get('/', 'HomeController@showWorstThings');

Route::get('/social-callback/facebook', 'HomeController@handleProviderCallback');
Route::get('/social-redirect/facebook', 'HomeController@redirectToProvider');

Route::put('/user', 'UserController@upsertUser');

Route::post('/downvote', [
	'uses' => 'HomeController@downvoteWorstThing', 
	'middleware' => 'auth'
]);

Route::get('/user-downvotes', [
	'uses' => 'HomeController@getUserDownvotes', 
	'middleware' => 'auth'
]);