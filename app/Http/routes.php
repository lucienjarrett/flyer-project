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



 

Route::group(['middleware' => 'web'], function () {


Route::controllers
	([
		'auth'=>'Auth\AuthController', 
		'password' => 'Auth\PasswordController'	
	]);



    Route::auth();

   Route::get('/pages/home', 'HomeController@index');
Route::get('/', function () {
    return view('pages.home');
});

Route::resource('flyers', 'FlyersController'); 
Route::get('{zip}/{street}', 'FlyersController@show'); 
//Route::post('{zip}/{street}/photos',['as' => 'store_photo_path', 'uses' => 'FlyersController@addPhoto']); 

Route::post('{zip}/{street}/photos',['as' => 'store_photo_path', 'uses' => 'PhotosController@store']); 








});


