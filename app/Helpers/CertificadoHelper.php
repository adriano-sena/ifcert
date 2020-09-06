<?php


namespace App\Helpers;


class CertificadoHelper
{


	/**
	 * @param $atividade
	 * @param $participante
	 *
	 * Emite um certificado para um participante de uma atividade
	 */
	public static function emitirCertificado($atividade, $participante){

		$usuario = \App\User::find($participante);
		$chave = md5($usuario->name . \Carbon\Carbon::now());

		$chaveReduzida = \Illuminate\Support\Str::substr($chave,0,15);

		$certificadoEmitido = new \App\CertificadoEmitido();
		$certificadoEmitido->chave = $chaveReduzida;

		/**
		 * o método associate é da relação de belongTO()
		 */
		$certificadoEmitido->user()->associate($usuario);
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
	public static function emitirListaCertificados($atividade, $participantes){

		foreach ($participantes as $participante){
			if (self::checaParticipacao($atividade, $participante))
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

	private function checaParticipacao($atividade, $participante){

		if($atividade->whereHas('users',function ($query) use ($participante){
			$query->where('users.id',$participante->id);
		})->wherePivot('participou', '=', 1)->first()){
			return true;
		}
		return false;
	}

}
