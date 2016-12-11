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

Route::any('/user',['as'=>'user.index','middleware'=>['auth'],'uses'=>'UserController@index']);

Route::any('/user/set',['as'=>'user.set','middleware'=>['auth'],'uses'=>'UserController@set']);

Route::post('/user/set',['as'=>'user.postset','middleware'=>['auth'],'uses'=>'UserController@postset']);

Route::post('/user/upload',['as'=>'user.upload','middleware'=>['auth'],'uses'=>'UserController@upload']);

//Route::any('/forum',['as'=>'forum.index','uses'=>'ForumController@index']);

Route::get('/forum',['as'=>'forum.index','uses'=> 'ForumController@index']);