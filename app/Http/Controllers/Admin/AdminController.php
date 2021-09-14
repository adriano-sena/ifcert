<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 *
 * Responsável pela parte de delegação de permissões e gerenciamento
 * do sistema
 */
class AdminController extends Controller
{

	public function __construct()
	{
		$this->middleware(['auth','role:super-admin']);
	}

	public function delegaFuncao(Request $request)
	{

	}

	public function registraParticipantes(Request $request, Atividade $atividade){
		//$users = User::find($request->participantes);
		//dd($request->all());
		$atividade->users()->updateExistingPivot($request->participantes, ['participou' => 1], false);
		return redirect()->back()->with('success', 'Registro de participantes realizado com sucesso');
	}
}
