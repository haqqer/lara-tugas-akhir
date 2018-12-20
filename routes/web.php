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
    Route::prefix('anggota')->group(function() {
        Route::get('/{id_name}', 'AnggotaController@index', 'id_name');
        Route::post('/{id_name}', 'AnggotaController@store', 'id_name');
        Route::get('/{id_name}/{id}', 'AnggotaController@show', 'id_name', 'id');
        Route::post('/{id_name}/{id?}', 'AnggotaController@store', 'id_name', 'id');
        Route::get('/{id_name}/{id}/delete', 'AnggotaController@delete', 'id_name', 'id');
    });
    Route::prefix('berita')->group(function() {
        Route::get('/', 'BeritaController@index');
        Route::get('/create', 'BeritaController@create');
        Route::get('/edit/{id}', 'BeritaController@edit', 'id');
        Route::post('/', 'BeritaController@store');
        Route::get('/{id}/delete', 'BeritaController@delete', 'id');
    });
    Route::prefix('kategori')->group(function() {
        Route::get('/', 'KategoriController@index');
    });
});

