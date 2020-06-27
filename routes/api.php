<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('auth/login','AuthController@login');

Route::group(['middleware' => ['apiJwt']], function () {
    
    //Security Route
    Route::post('auth/logout','AuthController@logout');
    Route::post('auth/refresh','AuthController@refresh');
    Route::get('auth/me','AuthController@me');
    
    
    Route::get('users','UserController@index');
    Route::get('users/whouser/{email}','UserController@whouser');
});



