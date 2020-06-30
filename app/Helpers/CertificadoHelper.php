<?php

namespace App\Helpers;

use App\Certificado;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class CertificadoHelper{



    public function salvaModelo(String $texto, string $background){

    	//Validar Futuramente se o tipo da imagem bate com um uri
        DB::beginTransaction();
        $modelo = Certificado::create(
            [
                'texto' => $texto,
                'background' => $background
            ]
        );
        DB::commit();
        return $modelo;
    }

     /**
     * Gera um arquivo pdf com base em um conteudo html passado
     * via parâmetro.
     *
     * Futuramente implementar função de opções
     */
    public static function geraCertificado($conteudoHtml){

        //Criando PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($conteudoHtml);
        $dompdf->setPaper('a4', 'landscape');

        //renderizando e dando o output
        $dompdf->render();
        return $dompdf;
   }

   public static function renderizaCertificado(Dompdf $rawPdf){
       $rawPdf->stream('certificado.pdf', ["Attachment" => false]);
   }



   /**
    * Recebe o texto padrão do certificado e o objeto
    * do usuário e retorna o texto montado para o Certificado
    */
   public function trataConteudo(String $texto, $dados) : String{
        //replaceArray da facade STR
   }
}

