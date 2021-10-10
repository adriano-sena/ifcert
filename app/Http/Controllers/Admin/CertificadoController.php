<?php

namespace App\Http\Controllers\Admin;

use App\Certificado;
use App\Evento;
use App\Helpers\ImagemHelper;
use App\Helpers\PDFHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{

	private $certificadoHelper;

	public function __construct()
	{
		$this->certificadoHelper = new PDFHelper();
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
    	$certificado = $evento->certificado()->get();
    	$certificado = $certificado->last();
        return view('painel.eventos.modelo-certificado', compact('evento', 'certificado'));
    }

    /**
     * Persiste um novo modelo de certificado relacionado
     * a um evento existente
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$evento = Evento::find($request->evento);

		$modelo = $evento->certificado()->get();

		if($modelo->isEmpty()){

			$data = $request->all();

			if($request->hasFile('imagem')){
				$data['imagem'] =  ImagemHelper::imageUpload($request);
			}
			$certificado = $evento->certificado()->create([
				'texto' => $data['content'],
				'background' => $data['imagem'],
			]);
			dd($certificado);
			flash('Modelo de certificado criado com sucesso')->success();
			return redirect()->back();
		}else {
			$modelo = $modelo->last();
			$certificado = Certificado::find($modelo->id);
			$certificado->texto = $request->content;
			$certificado->save();
			flash('Modelo modificado com sucesso')->success();
			return redirect()->back();
		}

    }
    /**
     * Apresenta o certificado relacionado ao evento
     *
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {

        $modelo = Evento::find($evento->id)->certificado;
        //dd($modelo);
        if(is_null($modelo)){
        	flash('O modelo ainda não foi criado');
        	return redirect()->back();
		}else {
			PDFHelper::exibeCertificado($modelo);
		}
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
