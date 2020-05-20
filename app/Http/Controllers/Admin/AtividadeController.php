<?php

namespace App\Http\Controllers\Admin;

use App\Atividade;
use App\Evento;
use App\Http\Controllers\Controller;
use App\Http\Requests\AtividadesRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $atividades = DB::table('atividades')->where('evento_id', $evento->id)->simplePaginate(1); //Retorna a collection como iterator
        return view('Admin.Atividade.index' , compact('atividades'));
    }

    public function listaAtividades(Request $request, Evento $evento)
    {   
        
        //$atividades = Atividade::paginate(10);
    
        $atividades = DB::table('atividades')->where('evento_id', $evento->id)->simplePaginate(1); //Retorna a collection como iterator
        
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
    public function show(Evento $evento, Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento ,Atividade $atividade)
    {
        return view('admin.atividade.edit', compact('atividade', 'evento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Evento $evento, Atividade $atividade, Request $request)
    {
        $data = $request->all();

        $atividade = Atividade::find($atividade->id);
        $atividade->update($data); //retorna boleano 

        flash('Atividade Atualizada com sucesso');
        return redirect()->route('atividades.lista', $evento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento ,Atividade $atividade)
    {
        $atividade =  Atividade::find($atividade->id);

        $atividade->delete();
        flash('Atividade excluída com sucesso')->success();
        return redirect()->route('atividades.lista', $evento);
    }

    public function inscricao(Atividade $atividade)
    {
        //Verificar se o user está logado  -> Realizado no Front com Blade statements
        //Verificar se a atividade tem vagas
        if ($atividade->qtd_vagas > 0){

            //Verificar se o usuário já está cadastrado na atividade

            $user_id = Auth::id();
            //Realizando a inscrição do usuário na atividade
            User::find($user_id)->atividades()->attach($atividade->id, ['participou' => 0]);
            
            Atividade::where('id' , $atividade->id)->decrement('qtd_vagas');
            flash('Inscrição realizada com sucesso, Em breve você receberá o seu email com todas as informações')->success();
            return redirect()->back();
        }



    }
}
