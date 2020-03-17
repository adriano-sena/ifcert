<?php

namespace App\Http\Controllers\Admin;

use App\Atividade;
use App\Evento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{

    private $atividade;

    //Injeta um objeto de atividade 
    public function __construct(Atividade $atividade)
    {
        $this->atividade = $atividade;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Evento $evento)
    {
        $atividades = $this->atividade->paginate(10);

        return view('Admin.Atividade.index' , compact('atividades'));
    }

    public function listaAtividades(Request $request, Evento $evento)
    {    
    
        $atividades = Atividade::paginate(10);
        
        $request->session()->put('evento', $evento->id);//armazenando o id do evento na sessão

        return view('Admin.Atividade.lista', compact('atividades', 'evento'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $reques, Evento $evento)
    {

        return view ('admin.atividade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Evento $evento)
    {
        //dados da requisição
        $data = $request->all();
        $data += [ "slug" => 'teste' ];
        $evento = \App\Evento::find($evento->id); //Evento pai que vem aninhado na requisição
        $evento->atividades()->create($data);

        flash('Atividade criada com sucesso')->success();

        return redirect()->route('atividades.lista', $evento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade, Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Atividade $atividade, Evento $evento)
    {
        return view('admin.atividade.edit', compact('atividade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atividade $atividade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atividade $atividade,Evento $evento)
    {
        //
    }
}
