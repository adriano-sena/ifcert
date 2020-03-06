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
    return view('Admin/index');
});

//Rotas de evento
Route::post('/admin/criar-evento','Admin\\EventoController@store');
Route::get('/admin/criar-evento', 'Admin\\EventoController@create');
Route::get('/admin/eventos','Admin\\EventoController@index')->name('listar-eventos');
