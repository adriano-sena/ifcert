<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

	public function __construct()
	{
		$this->middleware(['auth', 'permission:admin']);
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
		$users = $request->usuarios;
		foreach ($users as $user){
			$user->assignRole('moderador');
		}
		return redirect()->back()->with('success', 'Registro dos moderadores realizado com sucesso');
	}

	public function removeModerador(Request $request){
		$usuario = $request->user;
		$usuario->removeRole('moderador');
	}

}
