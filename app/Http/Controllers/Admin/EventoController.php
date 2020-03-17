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
        return view('Admin.index-eventos', compact('eventos'));
    }

    
    public function listaEventos()
    {    
        $eventos = Evento::paginate(10);
        return view('Admin.lista-eventos', compact('eventos'));
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

        return redirect()->route('admin.evento.lista');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show($evento)
    {
        $evento = Evento::find($evento);


        return view('evento', compact('evento'));
    }

    /**
     * Exibe o formulário para a edição do evento.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit($evento)
    {
        $evento = Evento::find($evento);

        return view('Admin.edit-evento', compact('evento') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$evento)
    {
        $data = $request->all();

        $evento = Evento::find($evento);
        $evento->update($data); //retorna boleano 

        flash('Evento Atualizado com sucesso');
        return redirect()->route('admin.evento.lista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy($evento)
    {
        $evento =  Evento::find($evento);

        $evento->delete();
        flash('Evento excluído com sucesso')->success();
        return redirect()->route('admin.evento.lista');
    }
}
