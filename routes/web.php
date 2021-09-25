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


use App\CertificadoEmitido;
use App\Http\Controllers\Admin\EventoController;

Route::get('/', 'HomeController@index')->name('home');

//Rotas de Admin Evento

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'as'=>'admin.'],function () {

    //Rotas de Eventos
    Route::get('/eventos/lista', 'EventoController@listaEventos')->name('evento.lista');
    Route::resource('eventos', 'EventoController');
	Route::get('eventos/{evento}','EventoController@show')->name('eventos.show')->middleware('role:user');

    //Rotas do painel adm
	Route::get('/painel/usuarios', 'AdminController@listaUsuarios')->name('usuarios.lista');
	Route::post('/painel/usuarios/registra', 'AdminController@delegaModerador')->name('usuarios.lista.moderadores');
	Route::get('/painel/usuarios/remove/moderador/{moderador}', 'AdminController@removeModerador')->name('usuarios.moderador.delete');


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

	//Certificação
	Route::post('/atividade/lista/certificados/{atividade}/','AtividadeController@emiteCertificados')->name('atividades.certificados.emite');

	Route::get('/atividade/lista/certificados/{atividade}', 'AtividadeController@listaParticipantes')->name('atividades.certificados');

	Route::get('/atividade/certificado/{atividade}/{user}', 'AtividadeController@exibirCertificado')->name('atividades.certificado');

	Route::get('/atividade/lista/{atividade}/pdf', 'AtividadeController@listaPDF')->name('atividades.lista.pdf');

    Route::resource('eventos.atividades', 'AtividadeController');


});

//Rotas públicas

Route::group(['middleware' => ['role:user']], function () {
	Route::get('/evento/{evento}', [EventoController::class , 'exibirEvento']);
});


Route::get('/autenticacao' , 'AutenticacaoController@autenticaCertificadoShow')->name('autentica.show');
Route::post('/autenticacao' , 'AutenticacaoController@autenticaCertificado')->name('autentica');


Auth::routes();

//Rotas de teste

Route::get('/emissao', function (){

	$usuario = \App\User::find(2);
	$atividade = \App\Atividade::find(1);

	$chave = md5($usuario->name . \Carbon\Carbon::now());

	//dd(\Illuminate\Support\Carbon::now()->toDateTimeString());

	$chaveReduzida = \Illuminate\Support\Str::substr($chave,0,15);

	$certificadoEmitido = new \App\CertificadoEmitido();
	$certificadoEmitido->chave = $chaveReduzida;

	$certificadoEmitido->user()->associate($usuario);
	$certificadoEmitido->atividade()->associate($atividade);
	$certificadoEmitido->save();


	echo  $certificadoEmitido;
});

Route::get('/fnx', function(){
	$atividade = \App\Atividade::find(2);
	//echo $atividade->evento->id . PHP_EOL. $atividade->evento->titulo;
	//$conteudo, $usuario,$atividade
	$usuario = \App\User::find(2);

	$evento = $atividade->evento;

	$certificado = $evento->certificado;

	$textoTratado = \App\Helpers\PDFHelper::trataConteudo($certificado->texto,$usuario,$atividade);
	echo $textoTratado;

});


Route::get('/check', function(){

	$atividade = \App\Atividade::find(2);
	$usuario = \App\User::find(4);

//	 $participante = $atividade->whereHas('users',function ($query) use ($usuario){
//		$query->where('users.id',$usuario->id);
//	})->first();

	 $participante = $usuario->whereHas('atividades', function ($query) use ($atividade){
	 	$query->where('atividades.id', $atividade->id);
	 });

	 dd($participante->wherePivot('participou', '=', 1));
});

Route::get('welcome', 'HomeController@welcome')->name('welcome');

Route::get('/fer', function(){

	$atividade = \App\Atividade::find(2);
	$usuario = \App\User::find(4);


	$certificado = CertificadoEmitido::where([
		'user_id'=> $usuario->id,
		'atividade_id' =>$atividade->id
	])->first();

	dd($certificado->chave);
});
