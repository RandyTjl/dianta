<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api','namespace'=>'Api\V1','prefix'=>"v1"], function () {
    Route::post('/auth/login',"AuthController@login");
	Route::post('/auth/verifyApiToken',"AuthController@verifyApiToken");
	Route::post('/auth/updatePwd',"AuthController@updatePwd");
	Route::post('/auth/logout',"AuthController@logout");
	Route::get('/auth/getForgetCode',"AuthController@getForgetCode");
	Route::post('/auth/forgetPwdUpdate',"AuthController@forgetPwdUpdate");

    Route::group(['middleware' => 'apiToken'],function (){
        Route::resource('/users',"UserController");
        Route::resource('/pylons',"PylonController");
    });
});