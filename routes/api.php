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

Route::post('login', 'API\AuthController@login');

Route::middleware('auth.jwt')->group(function (){
    Route::get('user', 'API\UserController@getAll');
    Route::post('user', 'API\UserController@add');
    Route::put('user', 'API\UserController@update');
});
