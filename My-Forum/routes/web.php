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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',['as'=>'index','uses'=> 'ForumController@defaultindex']);

//Route::get('test/test', 'TestController@test')->name('test.test');

Route::any('/test/test',['as'=>'test.test','uses'=>'TestController@test']);
Auth::routes();

#============================�û�����==============================
//Route::get('/user/index',['as'=>'user.index','uses'=>'HomeController@index','middleware'=>['auth']] );
Route::get('/user/index',['as'=>'user.index','uses'=>'UserController@index','middleware'=>['auth']] );

Route::any('/user',['as'=>'user.index','middleware'=>['auth'],'uses'=>'UserController@index']);

Route::any('/user/set',['as'=>'user.set','middleware'=>['auth'],'uses'=>'UserController@set']);

Route::post('/user/set',['as'=>'user.postset','middleware'=>['auth'],'uses'=>'UserController@postset']);

Route::post('/user/upload',['as'=>'user.upload','middleware'=>['auth'],'uses'=>'UserController@upload']);

Route::any('/user/message',['as'=>'user.message','middleware'=>['auth'],'uses'=>'UserController@message']);

Route::get('/user/home/{userID}',['as'=>'user.home','uses'=>'UserController@home']);
#============================�û�����==============================
//Route::any('/forum',['as'=>'forum.index','uses'=>'ForumController@index']);

#============================�������==============================
Route::get('/forum',['as'=>'forum.index','uses'=> 'ForumController@index']);

//Route::any('/forum/detail',['as'=>'forum.detail','uses'=>'ForumController@detail']);
Route::get('/forum/detail/',['as'=>'forum.detail','uses'=> 'ForumController@detail']);

Route::any('/forum/add/',['as'=>'forum.add','middleware'=>['auth'],'uses'=>'ForumController@add']);

Route::post('/forum/add/',['as'=>'forum.add','middleware'=>['auth'],'middleware'=>['auth'],'uses'=>'ForumController@postadd']);

Route::post('/forum/upload/',['as'=>'forum.upload','middleware'=>['auth'],'uses'=>'ForumController@upload']);

Route::post('/forum/postcomment',['as'=>'forum.postcomment','uses'=>'ForumController@postcomment']);

Route::post('/form/addlike',['as'=>'forum.addlike','uses'=>'ForumController@addlike']);


#============================�������==============================
Route::get('/forum/edit/{aid}',['as'=>'forum.edit','middleware'=>['auth'],'uses'=>'ForumController@edit']);

Route::post('/forum/postedit',['as'=>'forum.postedit','uses'=>'ForumController@postedit']);

#============================�������==============================

#============================�ӿ�==============================
Route::any('/api/mine-jie',['as'=>'api.mine-jie','uses'=>'ApiController@mine_jie']);

Route::any('/api/getmsgcount',['as'=>'api.getmsgcount','uses'=>'ApiController@getMsgCount']);


//��ȡ�û���Ϣ
Route::post('/api/msg/',['as'=>'api.message','uses'=>'ApiController@getMessage']);
//����Ϣ��Ϊ�Ѷ�
Route::post('/api/msgread/',['as'=>'api.msgread','middleware'=>['auth'],'uses'=>'ApiController@msgread']);
//ɾ���Ķ�����Ϣ
Route::post('/api/msg-del/',['as'=>'api.msgdel','middleware'=>['auth'],'uses'=>'ApiController@msgdel']);
//���ɽ��
Route::post('/api/jieda-accept/',['as'=>'api.jiedaaccept','middleware'=>['auth'],'uses'=>'ApiController@jiedaaccept']);
#============================�ӿ�==============================