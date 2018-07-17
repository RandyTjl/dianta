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

Route::group(['middleware' => 'Web','namespace'=>'Web'], function () {
    Route::get('/login', function () {
        return view('auth/login');
    });
    Route::get('/register', function () {
        return view('auth/register');
    });

    Route::post('/auth/login',"AuthController@login");
    Route::get('/auth/test',"AuthController@test");

    Route::group(['middleware' => 'guest'],function (){
        Route::get('/',function(){
            return view('index/index');
        });

        Route::resource('/account',"AccountController");
        Route::resource('/users',"UserController");
        Route::resource('/roles',"RoleController");

        Route::resource('/power',"PowerController");
    });

});


