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
    
    //Rotas de manutencao de usuarios
    Route::get('users','UserController@index');
    Route::get('users/whouser/{email}','UserController@whouser');
    Route::post('users/iduser/{id}','UserController@show');
    Route::post('users/updateuser/{id}','UserController@update');
    Route::post('users/newuser','UserController@store');
    Route::post('users/deleteuser/{id}','UserController@destroy');

    //Rotas de manutencao de Campanhas
    Route::get('campanhas','CampanhasController@index');
    Route::post('campanhas/idcampanha/{id}','CampanhasController@show');
    Route::post('campanhas/updatecampanha/{id}','CampanhasController@update');
    Route::post('campanhas/newcampanha','CampanhasController@store');
    Route::post('campanhas/deletecampanha/{id}','CampanhasController@destroy');

     //Rotas de manutencao de Distritos e Clubes
     Route::get('distrclubworlds','DistrclubworldsController@index');
     Route::post('distrclubworlds/iddistrclubworld/{id}','DistrclubworldsController@show');
     Route::post('distrclubworlds/updatedistrclubworld/{id}','DistrclubworldsController@update');
     Route::post('distrclubworlds/newdistrclubworld','DistrclubworldsController@store');
     Route::post('distrclubworlds/deletedistrclubworld/{id}','DistrclubworldsController@destroy');


});



