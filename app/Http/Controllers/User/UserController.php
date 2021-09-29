<?php

namespace App\Http\Controllers\User;

use App\CertificadoEmitido;
use App\Helpers\CertificadoHelper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
	public function __construct(){
		$this->middleware(["permission:visualizar-evento"]);
	}


	public function exibirCertificados(User $user){
		try {
			$certificados = CertificadoEmitido::where('user_id', $user->id)->get();
		}catch(\Exception $e){
			dd($e);
		}
		return $certificados;
	}

	/**
	 *
	 * Renderiza o certificado para o usuário
	 * @param CertificadoEmitido $certificado
	 */
	public function exibirCertificadoEspecifico(CertificadoEmitido $certificado){
		CertificadoHelper::exibeCertificado($certificado);
	}


	public function exibirInscricao(){

	}

	public function cancelarInscricao(){

	}

}
