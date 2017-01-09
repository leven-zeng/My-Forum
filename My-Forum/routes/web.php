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


#============================问答内容==============================
Route::get('/forum/edit/{aid}',['as'=>'forum.edit','middleware'=>['auth'],'uses'=>'ForumController@edit']);

Route::post('/forum/postedit',['as'=>'forum.postedit','uses'=>'ForumController@postedit']);

#============================问答内容==============================

#============================接口==============================
Route::any('/api/mine-jie',['as'=>'api.mine-jie','uses'=>'ApiController@mine_jie']);

Route::any('/api/getmsgcount',['as'=>'api.getmsgcount','uses'=>'ApiController@getMsgCount']);


//获取消息
Route::post('/api/msg/',['as'=>'api.message','uses'=>'ApiController@getMessage']);
//设置消息为已读
Route::post('/api/msgread/',['as'=>'api.msgread','middleware'=>['auth'],'uses'=>'ApiController@msgread']);
//删除消息
Route::post('/api/msg-del/',['as'=>'api.msgdel','middleware'=>['auth'],'uses'=>'ApiController@msgdel']);
//采纳回答
Route::post('/api/jieda-accept/',['as'=>'api.jiedaaccept','middleware'=>['auth'],'uses'=>'ApiController@jiedaaccept']);
#============================接口==============================

// 引导用户到新浪微博的登录授权页面
Route::get('auth/oauth/{driver}', ['as'=>'auth.oauth','uses'=>'Auth\AuthController@oauth']);
// 用户授权后新浪微博回调的页面
Route::get('auth/callback/{driver}', 'Auth\AuthController@callback');

Route::get('auth/bindAccount',['as'=>'auth.bindAccount','uses'=>'Auth\AuthController@bindAccount']);
//提交绑定
Route::post('auth/postBind',['as'=>'auth.postBind','uses'=>'Auth\AuthController@postBind']);