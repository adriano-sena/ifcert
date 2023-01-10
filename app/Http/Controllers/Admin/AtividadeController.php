<?php

namespace App\Http\Controllers\Admin;

use App\Atividade;
use App\Evento;
use App\Events\NovaInscricao;
use App\Helpers\CertificadoHelper;
use App\Helpers\InscricaoHelper;
use App\Helpers\PDFHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AtividadesRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\Exception\PartialFileException;

class AtividadeController extends Controller
{

    private $atividade;


    public function __construct(Atividade $atividade)
    {
    	$this->middleware(['auth']);
		$this->middleware('role_or_permission:admin|moderador')->except('inscricao');
		$this->middleware(['permission:visualizar-atividade'])->only('inscricao');
		$this->atividade = $atividade;
	}

    /**
     * Lista de atividades para o usuário Padrão.
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
        $atividades = DB::table('atividades')->where('evento_id', $evento->id)->simplePaginate(40); //Retorna a collection como iterator
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
			$event = new NovaInscricao($user, $atividade);
			event($event);
			return redirect()->back()->with('success', 'Inscrição realizada com sucesso, Logo chegará um e-mail com as informações da atividade!');
		}
		return redirect()->back()->with('success','Você já está inscrito nesta atividade, verifique sua caixa de e-mails para mais informações.');

    }

	/**
	 * Exibe todos os usuários que se inecreveram na atividade
	 */
    public function listaInscritos(Atividade $atividade){

    	$atividade = Atividade::with('users')->find($atividade->id);
    	return view('painel.atividades.inscritos', compact( 'atividade'));
	}


	/**
	 * @param Atividade $atividade
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 *
	 * Lista usuários que já participaram de determinada atividade
	 */
	public function listaParticipantes(Atividade $atividade){

		/**
		 *Modelo de querie
		$department = Department::findOrFail($id);
		$past = $department->users()
		->wherePivot('term_end_date', '<', '2017-10-10')
		->get(); // execute the query
		 */

    	$atividade = Atividade::with('users')->find($atividade->id);
    	$participantes = $atividade->users()->wherePivot('participou', '=', 1)->get();
    	return view('painel.atividades.emissao', compact('atividade', 'participantes'));
	}


	public function registraParticipantes(Request $request, Atividade $atividade){
		//$users = User::find($request->participantes);
			//dd($request->all());
			$atividade->users()->updateExistingPivot($request->participantes, ['participou' => 1], false);
		return redirect()->back()->with('success', 'Registro de participantes realizado com sucesso');
	}


	public function removeRegistroParticipante(Atividade $atividade, $inscrito){

    	$atividade->users()->updateExistingPivot($inscrito, ['participou' => 0] , false);
    	return redirect()->back()->with('success', 'Participação removida com sucesso');
	}

	public function listaPDF(Atividade $atividade){
    	$evento = $atividade->evento;
		PDFHelper::exibeListaInscritos($atividade->users, $evento, $atividade);
	}

	public function emiteCertificados($atividade){
		CertificadoHelper::emitirListaCertificados($atividade);
		return redirect()->back()->with("Certificados emitidos com sucesso");
	}

	public function exibirCertificado($atividade,$participante){

		$atividade = Atividade::find($atividade);
		$participante = User::find($participante);
		$evento = $atividade->evento;


		PDFHelper::renderizaCertificado($evento, $atividade, $participante);

	}
}

