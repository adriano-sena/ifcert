<?php


namespace App\Helpers;


use Illuminate\Http\Request;

class ImagemHelper
{


	/**
	 * Retorna o Path da imagem salva no sistema
	 */
	public static function imageUpload(Request $request){

		$imagem = $request->file('imagem');//Objeto de Uploaded Image

		$uploadedImage = $imagem->store('imagem' , 'public');

		return $uploadedImage;
	}
}
