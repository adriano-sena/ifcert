<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Evento;



class TagController extends Controller{


    /**
     * Recebe e processa a requisição ajax 
     * retorna o objeto criado como json
     * para ser exibido na página do certificado
     */
    public function store(Request $request, Evento $evento){
         
         $request->tag;
         $request->evento;
         
         //Valodar a tag (se começa com # e se não possui espaços em branco ou outro tipo de caractere)
            //ltrim -> remove espaços em branco 
            //rtrim  -> remove espaços em branco no final da string

         $tag['success'] = 'true';
         $tag['tag'] = $request->tag;
         echo json_encode($tag);


    }
}
