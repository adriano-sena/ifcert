<?php

namespace App\Helpers;

use App\Certificado;
use App\User;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

/**
 * Class PDFHelper
 * @package App\Helpers
 *
 * Classe de suporte que contém regras de negócio para
 * criação de arquivos PDF e
 */
class PDFHelper{


    public function salvaModelo(String $texto, String $background){

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

   public static function renderizaPDF(Dompdf $rawPdf){
       $rawPdf->stream('certificado.pdf', ["Attachment" => false]);
   }


   /**
    * Recebe o texto padrão do certificado e o objeto
    * do usuário e retorna o texto montado para o Certificado
    */
   public function trataConteudo(String $texto, $dados) : String{
        //replaceArray da facade STR
   }

	/**
	 * Exibe o certificado relacionado ao evento
	 */
   public static function exibeCertificado(Certificado $certificado) {

	   $pdf = view('certificados.certificado', compact('certificado'))->render();
	   $certificadoPDF = self::geraCertificado($pdf);
	   //renderizando e exibendo na tela
	   self::renderizaPDF($certificadoPDF);
   }

	/**
	 * Gera um arquivo pdf com base em um conteudo html passado
	 * via parâmetro.
	 *
	 */
	public static function geraListaInscritos($conteudoHtml){
		//Criando PDF
		$dompdf = new Dompdf();
		$dompdf->loadHtml($conteudoHtml);
		$dompdf->setPaper('a4', 'portrait');
		//renderizando e dando o output
		$dompdf->render();
		return $dompdf;
	}

	public static function exibeListaInscritos($inscritos, $evento, $atividade){
		$pagina = view('certificados.lista-inscritos', compact('inscritos', 'evento', 'atividade'))->render();
		$listaPDF = self::geraListaInscritos($pagina);
		self::renderizaPDF($listaPDF);
	}
}
