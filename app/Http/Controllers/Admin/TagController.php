<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use App\Evento;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;


class TagController extends Controller{


    /**
     * Recebe e processa a requisição ajax
	 * Valida o a tag
     * retorna o objeto criado como json
     * para ser exibido na página do certificado
     */
    public function store(Request $request){


		if (!$this->validaTag($request->tag)) {
			$tag['success'] = false;
			$tag['message'] = "A tag não corresponde ao padrão estabelecido";
			$tag['tag'] = $request->tag;
			echo json_encode($tag);
			return;

		}else{
			//persistencia da tag no evento
			$evento = Evento::find($request->evento);
			$evento->tags()->create([
				'tag' => $request->tag
			]);

			$tag['success'] = true;
			$tag['tag'] = $request->tag;
			$tag['evento'] = $request->evento;
			$tag['message'] = "A tag corresponde as especificações";
			echo json_encode($tag);
			return;
		}
		return;
    }

    public function destroy($tag){

    	$tag->delete();
	}

	private function validaTag(String $tag) {

    	$padrao = "/^#[a-z]{1,15}[^\s\"\-\@#$%¨&*()+§=ª[º}{¬°<>.,\|]+$/";
    	return preg_match($padrao, $tag);
	}


}
