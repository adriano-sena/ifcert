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

// Route::get('/', function () {
//     return redirect('admin/eventos');
// });

Route::get('/', 'HomeController@index');

//Rotas de Admin Evento
Route::prefix('admin')->namespace('Admin')->middleware('checkAdmin')->group(function () {
    
    //Rotas de Eventos

    Route::get('/eventos/lista', 'EventoController@listaEventos')->name('admin.evento.lista');

    Route::resource('eventos', 'EventoController');

    //Recursos aninhados (Relação Evento/Atividade);
    Route::get('/atividades/lista/{evento}' , 'AtividadeController@listaAtividades')->name('atividades.lista');
    Route::resource('eventos.atividades', 'AtividadeController');

    // Route::resource('atividades', 'AtividadeController');

   
});




Auth::routes();

//Rotas de teste

Route::get('/home', 'HomeController@index')->name('home');

Route::get('welcome', 'HomeController@welcome')->name('welcome');