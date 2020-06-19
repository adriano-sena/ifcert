<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Evento;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;


class TagController extends Controller{


    /**
     * Recebe e processa a requisição ajax
	 * Valida o a tag -> na validação foi utilizada a criação
	 * de um validador manual, pois seria apenas um item a ser verificado
	 * e para deixar o código mais compreensível
     * retorna o objeto criado como json
     * para ser exibido na página do certificado
     */
    public function store(Request $request, Evento $evento){


		if (!$this->validaTag($request->tag)) {
			$tag['success'] = false;
			$tag['message'] = "A tag não corresponde ao padrão estabelecido";
			$tag['tag'] = $request->tag;
			echo json_encode($tag);
			return;

		}else{
			$tag['success'] = true;
			$tag['tag'] = $request->tag;
			$tag['evento'] = $request->evento;
			$tag['message'] = "A tag corresponde as especificações";
			echo json_encode($tag);
			return;
		}
		return;
    }


//	private function sanitizeTag(String $tag): String {
//
//		$tagLimpa = preg_replace( array( '/[ ]/' , '/[^A-Za-z0-9\-]/' ) , array( '' , '' ) , $tag );
//
//		return $tagLimpa;
//	}

	private function validaTag(String $tag) {

    	$padrao = "/^#[a-z]{1,15}[^\s\"\-\@#$%¨&*()+§=ª[º}{¬°<>.,\|]+$/";
    	return preg_match($padrao, $tag);
	}


}
