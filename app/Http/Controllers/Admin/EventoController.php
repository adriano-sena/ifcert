<?php

namespace App\Http\Controllers\Admin;

use App\Evento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = \App\Evento::paginate(10);
        return $eventos; 
    }

    /**
     * Exibe o formulário para criação do Evento
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.form-evento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        $evento = Evento::create([
            'titulo' => $request->titulo,
            'subTitulo' => $request->subTitulo ,
            'slug' => 'Titulo-Subtitulo',
            'descricao' => $request->descricao,
            'local' => $request->local,
            'data' => $request->data,
            'organizador' => $request->organizador,
            'telefone' => '7399955564'
        ]);

        return redirect()->route('listar-eventos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
