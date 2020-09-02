<?php


namespace App\Helpers;


class CertificadoHelper
{

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

		echo  $certificadoEmitido;
	}
}
