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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', function() {
    return view('layouts/admin');
})->name('admin')->middleware('auth');

Route::prefix('admin')->group(function() {
    // Route::get('/', '');dosen
    Route::get('anggota/{id_name}', 'AnggotaController@index', 'id_name');
    Route::post('anggota/{id_name}', 'AnggotaController@store', 'id_name')->name('anggota.daftar');
    Route::get('anggota/{id_name}/{id}', 'AnggotaController@show', 'id_name', 'id');
    Route::post('anggota/{id_name}/{id?}', 'AnggotaController@store', 'id_name', 'id');
});

