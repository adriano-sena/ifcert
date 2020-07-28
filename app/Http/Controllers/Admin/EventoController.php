<?php

namespace App\Http\Controllers\Admin;

use App\Evento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventosRequest;

class EventoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:admin'])->except('index');
    }

    /**
     * Exibe a lista dos eventos para o usuário padrão
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = \App\Evento::paginate(10);
        return view('Admin.index-eventos', compact('eventos'));
    }


    /**
     *
     * Exibe a listagem de eventos para o administrador
     */
    public function listaEventos()
    {
        $eventos = Evento::paginate(10);
        return view('painel.eventos.lista', compact('eventos'));
    }

    /**
     * Exibe o formulário para criação do Evento
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.eventos.create');
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

        //Adição da imagem

        if($request->hasFile('imagem')){
            $data['imagem'] = $this->imageUpload($request);
        }


        $evento = Evento::create($data);

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
        $atividades = $evento->atividades;

        //Verificar se o evento possui atividades
			//Se possuir apresentar direcionar para a view do evento com a listagem de atividades
			//Senão enviar para uma página informando que o evento ainda não possui atividades cadastradas
        return view('evento', compact('evento', 'atividades'));
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

        return view('painel.eventos.edit', compact('evento'));
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

    /**
     * Retorna o Path da imagem salva no sistema
     */
    private function imageUpload(Request $request){

      $imagem = $request->file('imagem');

      $uploadedImage = $imagem->store('imagem' , 'public');

      return $uploadedImage;

    }
}
