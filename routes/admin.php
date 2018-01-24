<?php

//管理后台
Route::group(['prefix' => 'admin'], function () {
    //登录展示页面
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    //登录行为
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    //登出行为
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');
    //使用中间件控制auth
    Route::group(['middleware' => 'auth:admin'], function () {
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');
        //管理人员模块
        Route::get('/users', '\App\Admin\Controllers\UserController@index');
        Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
        Route::post('/users/store', '\App\Admin\Controllers\UserController@store');

        //审核模块
        Route::get('/posts', '\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
    });

    //专题模块
//    Route::group(['middleware' => 'can:post'], function () {
    Route::resource('topics', '\App\Admin\Controllers\TopicController', ['only' => ['index', 'create', 'store', 'destroy']]);
//    });

    Route::resource('notices', '\App\Admin\Controllers\NoticeController', ['only' => ['index', 'create', 'store']]);
});