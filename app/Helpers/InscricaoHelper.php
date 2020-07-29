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
		//Checar na tabela pivot de inscrição se o id do usuário e o id da atividade estão inseridos

//		dd($atividade->whereHas('users',function ($query) use ($user){
//			$query->where('users.id',$user->id);
//		})->first());

		if($atividade->whereHas('users',function ($query) use ($user){
			$query->where('users.id',$user->id);
		})->first()){
			return true;
		}
		return false;
	}

	public static function haVagas(Atividade $atividade){
		if($atividade->qtd_vagas == $atividade->users->count()){
			return false;
		}
		return true;
	}



}
