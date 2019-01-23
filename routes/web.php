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
    return view('welcome');
});

Route::any('/wechat', 'WeChatController@serve');

Route::any('/award', 'AwardController@award');

Route::any('/wechatUser', 'WeChatController@wechatUser');

Route::any('/FwechatUser', 'WeChatController@FwechatUser');

Route::any('/Fcallback', 'WeChatController@Fcallback');

Route::any('/b','WeChatController@b');
