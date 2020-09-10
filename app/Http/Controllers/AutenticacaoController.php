<?php

namespace App\Http\Controllers;

use App\CertificadoEmitido;
use Illuminate\Http\Request;

class AutenticacaoController extends Controller
{
    //

	public function autenticaCertificadoShow(Request $request){
		return view('painel.autenticacao-form');
	}

	public function autenticaCertificado(Request $request){
		$certificado = CertificadoEmitido::where('chave', $request->chave)->first();

		if(is_null($certificado)){
			return redirect()->back()->with('error', 'Chave não encontrada em nosso sistema');
		}

		$atividade = $certificado->atividade;
		$participante = $certificado->user;
		return view('painel.autenticacao', compact(['certificado', 'atividade', 'participante']));
	}
}
