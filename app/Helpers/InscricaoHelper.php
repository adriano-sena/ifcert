<?php


namespace App\Helpers;


use App\Atividade;
use App\User;

class InscricaoHelper
{
	/**
	 * @param Atividade $atividade
	 * @param User $user
	 *
	 * Verifica no banco de dados se o usuário já possui inscricão na atividade
	 */
	public static function checaInscricao(Atividade $atividade, User $user) {

		if($atividade->users->contains($user)){
			return true;
		}
		return false;
	}

	/**
	 * @param Atividade $atividade
	 * @return bool
	 */
	public static function haVagas(Atividade $atividade){
		if($atividade->users->count() > $atividade->qtd_vagas){
			return false;
		}
		return true;
	}


	public static function qtdInscritos(Atividade $atividade) {
		return $atividade->users->count();
	}

	public static  function usuariosInscritos(Atividade $atividade) : User{

		return User::has('atividades')->orderBy('name')->get();
	}

//	public static function geraListaInscritos(Atividade $atividade){
//
//	}



}
