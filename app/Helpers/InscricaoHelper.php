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
	public static function checaInscricao(Atividade $atividade, User $user) : boolean{
		//Checar na tabela pivot de inscrição se o id do usuário e o id da atividade estão inseridos
	}



}
