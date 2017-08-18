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

Route::get('/', function () {
    return view('index');
});

Route::get('details/{id}', function(){
	return view('details');
});

/*Route::get('cart', function(){
	return view('cart');
});*/


Route::group(["middleware" => "auth"], function(){
	Route::get('admin', function(){
		return view('admin/index');
	});
});

Auth::routes();

Route::get('/', 'HomeController@index');
