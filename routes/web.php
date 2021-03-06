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

Route::get('/', function() {
    return view('index');
});

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
        Route::get('/{id}/show', 'BeritaController@show', 'id');
        Route::get('/create', 'BeritaController@create');
        Route::get('/{id}/edit', 'BeritaController@edit', 'id');
        Route::post('/{id?}', 'BeritaController@store', 'id');
        Route::get('/{id}/delete', 'BeritaController@delete', 'id');
    });
    Route::prefix('materi')->group(function() {
        Route::get('/', 'MateriController@index');
        Route::get('/{id}/show', 'MateriController@show', 'id');
        Route::get('/create', 'MateriController@create');
        Route::get('/{id}/edit', 'MateriController@edit', 'id');
        Route::post('/{id?}', 'MateriController@store', 'id');
        Route::get('/{id}/delete', 'MateriController@delete', 'id');
    });
    Route::prefix('kategori')->group(function() {
        Route::get('/', 'KategoriController@index');
    });
    Route::prefix('kegiatan')->group(function() {
        Route::get('/', 'KegiatanController@index');
        Route::get('/{id}/show', 'KegiatanController@show', 'id');
        Route::get('/jenis_kegiatan', 'KegiatanController@jenis_kegiatan');
        Route::get('/create', 'KegiatanController@create');
        Route::get('/{id}/edit', 'KegiatanController@edit', 'id');
        Route::post('/{id?}', 'KegiatanController@store', 'id');
        Route::get('/{id}/delete', 'KegiatanController@delete', 'id');
    });
    Route::prefix('download')->group(function() {
        Route::get('/', 'DownloadController@index');
        Route::post('/', 'DownloadController@store');
        Route::get('/kategori', 'DownloadController@kategori');
        Route::get('/{id}', 'DownloadController@show', 'id');
        Route::post('/{id?}', 'DownloadController@store', 'id');
        Route::get('/{id}/delete', 'DownloadController@delete', 'id');
    });
    Route::prefix('publikasi')->group(function() {
        Route::get('/', 'PublikasiController@index');
        Route::get('/{id}/show', 'PublikasiController@show', 'id');
        Route::get('/create', 'PublikasiController@create');
        Route::get('/{id}/edit', 'PublikasiController@edit', 'id');
        Route::post('/{id?}', 'PublikasiController@store', 'id');
        Route::get('/{id}/delete', 'PublikasiController@delete', 'id');
    });
    Route::prefix('topik')->group(function() {
        Route::get('/', 'TopikController@index');
        Route::post('/', 'TopikController@store');
        Route::get('/kategori', 'TopikController@kategori');
        Route::get('/{id}', 'TopikController@show', 'id');
        Route::post('/{id?}', 'TopikController@store', 'id');
        Route::get('/{id}/delete', 'TopikController@delete', 'id');
    });
});

