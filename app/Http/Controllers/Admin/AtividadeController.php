<?php

namespace App\Http\Controllers\Admin;

use App\Atividade;
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
    public function index()
    {
        $atividades = $this->atividade->paginate(10);

        return view('Admin.Atividade.index' , compact('atividades'));
    }

    public function listaAtividades(Request $request)
    {    
        $evento = $request->evento;

        
        $atividades = Atividade::paginate(10);
        return view('Admin.Atividade.lista', compact('atividades'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view ('admin.atividade.create');
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

        $evento = \App\Evento::find($data['evento']);
        $evento->atividades()->create($data);

        flash('Atividade criada com sucesso')->success();

        return redirect()->route('atividades.lista');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Atividade $atividade)
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
    public function destroy(Atividade $atividade)
    {
        //
    }
}
