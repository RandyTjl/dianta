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

Route::group(['middleware' => 'Web'], function () {
    Route::get('/login', function () {
        return view('auth/login');
    });

    Route::post('/auth/login',"AuthControoler@login");

    //Route::group(['middleware' => 'auth'],function (){
        Route::get('/',function(){
            return view('index/index');
        });

        Route::get('user/profile', function () {
            // 使用 Auth 中间件
        });
    //});

});


