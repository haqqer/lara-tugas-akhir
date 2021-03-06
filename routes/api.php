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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/{id?}', 'MainController@index', 'id');
Route::get('/landing/{id?}', 'MainController@landing', 'id');
Route::get('/{id_name}/{id?}', 'MainController@show', 'id_name', 'id');