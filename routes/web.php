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


Route::get('/', 'HomeController@index')->name('home');

//Rotas de Admin Evento
Route::group(['prefix'=>'admin','namespace'=>'Admin', 'as'=>'admin.'],function () {

    //Rotas de Eventos
    Route::get('/eventos/lista', 'EventoController@listaEventos')->name('evento.lista');
    Route::resource('eventos', 'EventoController');

	//Modelo de certificado
    Route::get('modelo/create/{evento}', 'CertificadoController@create')->name('modelo.certificado.create');
    Route::post('/modelo/store/{evento}', 'CertificadoController@store')->name('modelo.certificado.store');
    Route::get('/modelo/exibe/{evento}', 'CertificadoController@show')->name('modelo.certificado.show');

    //Tags do evento
    Route::post('/tags/store', 'TagController@store')->name('tags.store');

    //Recursos aninhados (Relação Evento/Atividade);
    Route::get('/atividades/lista/{evento}' , 'AtividadeController@listaAtividades')->name('atividades.lista');

    Route::post('/atividade/{atividade}/inscricao/', 'AtividadeController@inscricao')->name('eventos.atividades.inscricao');

    Route::get('/atividade/lista/inscritos/{atividade}', 'AtividadeController@listaInscritos')->name('atividades.inscritos');
    Route::post('/atividade/lista/inscritos/{atividade}', 'AtividadeController@registraParticipantes')->name('atividades.inscritos.registra');
    Route::get('/atividade/lista/inscritos/{atividade}/remover/{inscrito}', 'AtividadeController@removeRegistroParticipante')->name('atividades.inscritos.remove');

    Route::get('/atividade/lista/{atividade}/pdf', 'AtividadeController@listaPDF')->name('atividades.lista.pdf');

    Route::resource('eventos.atividades', 'AtividadeController');


});

//Rotas públicas


Auth::routes();

//Rotas de teste

Route::get('/emissao', function (){

	$usuario = \App\User::find(3);

	$chave = md5($usuario->name . \Carbon\Carbon::now()->toDateTimeString());

	//dd(\Illuminate\Support\Carbon::now()->toDateTimeString());

	$chaveReduzida = \Illuminate\Support\Str::substr($chave,0,15);

	$certificadoEmitido = \App\CertificadoEmitido::create(
		[
			'user' => 3,
			'atividade' => 1,
			'chave' => $chaveReduzida
		]
	);

	echo  $certificadoEmitido;
});


Route::get('welcome', 'HomeController@welcome')->name('welcome');
