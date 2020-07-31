<?php

namespace App\Http\Controllers\Admin;

use App\Atividade;
use App\Evento;
use App\Helpers\InscricaoHelper;
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
    	$this->middleware(['auth'])->except('listaAtividades','index');
    	$this->middleware(['auth','role:admin'])->only('index');
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

        return view('painel.atividades.lista', compact('atividades', 'evento'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $reques, Evento $evento)
    {
        return view ('painel.atividades.create');
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
        $data += [ "slug" => 'teste', 'qtd_vagas' =>$request->vagas];
        $evento = \App\Evento::find($evento->id); //Evento pai que vem aninhado na requisição
        $evento->atividades()->create($data);

        flash('Atividade criada com sucesso')->success();

        return redirect()->route('admin.atividades.lista', $evento);
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
        return view('painel.atividades.edit', compact('atividade', 'evento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Evento $evento, Atividade $atividade, Request $request)
    {
        $data = $request->all();

        $atividade = Atividade::find($atividade->id);
        $atividade->update($data); //retorna boleano

        flash('Atividade Atualizada com sucesso');
        return redirect()->route('admin.atividades.lista', $evento);
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
        return redirect()->route('admin.atividades.lista', $evento);
    }

    public function inscricao(Atividade $atividade)
    {

    	$user = Auth::user();
    	$inscrito = InscricaoHelper::checaInscricao($atividade, $user);
		$vagas = InscricaoHelper::haVagas($atividade);

		if(!$inscrito){
			if(!$vagas){
				return redirect()->back()->with('error','Que pena, Não existem mais vagas para esta atividade :(');
			}
			$user->atividades()->attach($atividade->id);
			return redirect()->back()->with('success', 'Inscrição realizada com sucesso, Logo chegará um e-mail com as informações da atividade!');
		}
		return redirect()->back()->with('success','Você já está inscrito nesta atividade, verifique sua caixa de e-mails para mais informações.');

    }

	/**
	 * Exibe todos os usuários que se inecreveram na atividade
	 */
    public function listaInscritos(Atividade $atividade){

    	$atividade = Atividade::find($atividade->id);

    	$inscritos = $atividade->users()->get();

    	return view('painel.atividades.inscritos', compact('inscritos'));
	}
}

