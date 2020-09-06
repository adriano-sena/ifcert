<?php

namespace App\Http\Controllers;

use App\CertificadoEmitido;
use Illuminate\Http\Request;

class CerttificadoEmitidoController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Emite uma lista de certificados e armazena na base de dados
	 * retorna o usuário para a listagem de certificados com uma flash message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CertificadoEmitido  $certtificadoEmitido
     * @return \Illuminate\Http\Response
     */
    public function show(CertificadoEmitido $certtificadoEmitido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CertificadoEmitido  $certtificadoEmitido
     * @return \Illuminate\Http\Response
     */
    public function edit(CertificadoEmitido $certtificadoEmitido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CertificadoEmitido  $certtificadoEmitido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CertificadoEmitido $certtificadoEmitido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CertificadoEmitido  $certtificadoEmitido
     * @return \Illuminate\Http\Response
     */
    public function destroy(CertificadoEmitido $certtificadoEmitido)
    {
        //
    }
}
