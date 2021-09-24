<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
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
=======
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

	public function __construct()
	{
		$this->middleware(['auth', 'role:admin']);
	}

	/**
	 * Exibe todos os usuários do sistema
	 *
	 */
	public function listaUsuarios(){
		$usuarios = User::all();
		return view('painel.eventos.usuarios', compact('usuarios'));
	}

	/**
	 * Delega o papel de moderador a todos os usuários
	 * selecionados pelo Administrador do sistema
	 */
	public function delegaModerador(Request $request){
		$users = User::find($request->usuarios);
		foreach ($users as $user){
			$user->assignRole('moderador');
		}
		return redirect()->back()->with('success', 'Registro dos moderadores realizado com sucesso');
	}

	public function removeModerador($moderador){
		$usuario = User::find($moderador);
		$usuario->removeRole('moderador');
		return redirect()->back()->with('success', 'Moderador removido com sucesso');
	}

>>>>>>> feature/permissions
}
