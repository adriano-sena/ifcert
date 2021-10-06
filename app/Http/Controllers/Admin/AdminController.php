<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 *
 * Responsável pela parte de delegação de permissões e gerenciamento
 * do sistema
 */

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

}
