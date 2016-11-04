<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Route::get('test/test', 'TestController@test')->name('test.test');

Route::any('/test/test',['as'=>'test.test','uses'=>'TestController@test']);
Auth::routes();

Route::get('/home', 'HomeController@index');
