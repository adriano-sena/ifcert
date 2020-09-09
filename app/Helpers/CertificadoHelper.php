<?php


namespace App\Helpers;


use App\Atividade;
use App\CertificadoEmitido;

class CertificadoHelper
{


	/**
	 * @param $atividade
	 * @param $participante
	 *
	 * Emite um certificado para um participante de uma atividade
	 */
	public static function emitirCertificado($atividade, $participante){

		$chave = md5($participante->name . \Carbon\Carbon::now());
		$chaveReduzida = \Illuminate\Support\Str::substr($chave,0,15);

		$certificadoEmitido = new \App\CertificadoEmitido();
		$certificadoEmitido->chave = $chaveReduzida;

		/**
		 * o método associate é da relação de belongTO()
		 */
		$certificadoEmitido->user()->associate($participante);
		$certificadoEmitido->atividade()->associate($atividade);
		$certificadoEmitido->save();
	}

	/**
	 * @param $atividade
	 * @param $participante
	 *
	 * Emite certificados para uma lista de participantes de uma
	 * atividade
	 */
	public static function emitirListaCertificados($atividade){

		$atividade = Atividade::find($atividade);
		$participantes = $atividade->users()->wherePivot('participou', '=', 1)->get();

		foreach ($participantes as $participante){
			if (self::checaParticipacao($atividade, $participante))
				if (!self::checaCertificacao($atividade, $participante))
					self::emitirCertificado($atividade,$participante);
			else{
				 echo ("erro na emissão do certificado");
			}
		}
	}

	/**
	 * @param $atividade
	 * @param $participante
	 *
	 * Valida a participação do usuário na atividade
	 */

	private static function checaParticipacao($atividade, $participante){

		if($atividade->whereHas('users',function ($query) use ($participante){
			$query->where('users.id',$participante->id);
			})->wherePivot('participou', '=', 1)){
			return true;
		}
		return false;
	}

	/**
	 * @param $atividade
	 * @param $participante
	 *
	 * Verifica a existência do certificado para um usuário na tabela de certificação
	 */
	private static function checaCertificacao($atividade, $participante){
		if($participante->certificadoEmitidos()->where('atividade_id', $atividade->id)->first()){
			return true;
		}
		return false;
	}

}
