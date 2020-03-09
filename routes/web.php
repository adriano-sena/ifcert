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
    Route::get('/eventos/lista', 'EventoController@listaEventos')->name('admin.evento.lista');
    Route::post('/criar-evento', 'EventoController@store')->name('admin.evento.store');
    Route::get('/criar-evento', 'EventoController@create')->name('admin.evento.create');
    Route::get('/{evento}/editar', 'EventoController@edit')->name('admin.evento.editar');//redireciona para o formulário 
    Route::post('/atualizar/{evento}', 'EventoController@update')->name('admin.evento.atualiza');//processa a atualização
    Route::get('/deletar/{evento}', 'EventoController@destroy')->name('admin.evento.deleta');
    Route::get('/exibir/{evento}', 'EventoController@show')->name('exibe-evento');//exibe um evento específico
    
});



