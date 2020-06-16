<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Evento;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;


class TagController extends Controller{


    /**
     * Recebe e processa a requisição ajax
     * retorna o objeto criado como json
     * para ser exibido na página do certificado
     */
    public function store(Request $request, Evento $evento){

         $request->tag;
         $request->evento;

		$tag['success'] = 'true';
		$tag['tag'] = $request->tag;
		$tag['evento'] = $request->evento;
		echo json_encode($tag);
    }

    private function validaTag(String $tag): Boolean {

    	trim($tag);//limpa os espaços em branco
		if (!Str::startsWith($tag, "#")){
			return false;
		}
    	return true;
	}
}
