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

//Rotas de Admin Evento
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/eventos', 'EventoController@index')->name('admin.evento.index');
    Route::post('/criar-evento', 'EventoController@store')->name('admin.evento.store');
    Route::get('/criar-evento', 'EventoController@create')->name('admin.evento.create');
    Route::get('/{evento}/editar', 'EventoController@edit')->name('admin.evento.');//redireciona para o formulário 
    Route::post('/atualizar/{evento}', 'EventoController@update')->name('admin_listar_eventos');//processa a atualização
    Route::get('/deletar/{evento}', 'EventoController@destroy')->name('deletar-evento');
    
});
