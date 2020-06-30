<?php

namespace App\Http\Controllers\Admin;

use App\Certificado;
use App\Evento;
use App\Helpers\CertificadoHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{

	private $certificadoHelper;

	public function __construct()
	{
		$this->certificadoHelper = new CertificadoHelper();
	}


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Evento $evento)
    {
        return view('painel.eventos.modelo-certificado', compact('evento'));
    }

    /**
     * Persiste um novo modelo de certificado relacionado
     * a um evento existente
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//remover campo de layout do modelo
		$evento = Evento::find($request->evento);
		$certificado = $evento->certificado()->create([
			'texto' => $request->content,
			'background' => '/img/modelos/modelo2.jpeg',
		]);

		flash('Modelo de certificado criado com sucesso')->success();

		//retorna para a página do modelo com o certificado já criado
		return redirect()->back()->withInput(['certificado' => $certificado]);
    }

    /**
     * Apresenta o certificado em questão
     *
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function show(Certificado $certificado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificado $certificado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificado $certificado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificado $certificado)
    {
        //
    }
}
