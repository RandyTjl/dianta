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

/*Route::get('/user', function (Request $request) {
    return 1;
    return $request->user();
})->middleware('api');*/
Route::group(['middleware' => 'api','namespace'=>'Api\V1','prefix'=>"v1"], function () {
    Route::get('/auth/login',"AuthController@login");
});