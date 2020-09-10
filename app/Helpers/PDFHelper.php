<?php

namespace App\Helpers;

use App\Atividade;
use App\Certificado;
use App\CertificadoEmitido;
use App\Evento;
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

   public static function renderizaPDF(string $fileName, Dompdf $rawPdf){
    	$titulo = $fileName . ".pdf";
       $rawPdf->stream($titulo, ["Attachment" => false]);
   }


   /**
    * Recebe o texto padrão do certificado e o objeto
    * do usuário e retorna o texto montado para o Certificado
    */
   public static function trataConteudo($conteudo, $usuario,$atividade) : String{
		//Tags hardcoded -> serão dinamicas no próximo release
	    $tags = ["#nome", "#atividade" , "#data" ,"#horas"];
	    $dados = [
	    	$usuario->name,
			$atividade->titulo,
			$atividade->data,
			$atividade->cargaHoraria
		];
	   	$textoTratado = str_replace($tags,$dados,$conteudo);

	   	return $textoTratado;
   }

	/**
	 * Exibe o modelo do certificado relacionado ao evento
	 */
   public static function exibeCertificado(Certificado $certificado) {

	   $pdf = view('certificados.certificado', compact('certificado'))->render();
	   $certificadoPDF = self::geraCertificado($pdf);
	   //renderizando e exibendo na tela
	   self::renderizaPDF("Modelo",$certificadoPDF);
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

	/**
	 * renderiza o certificado gerado para o usuário
	 */

	public static function renderizaCertificado(Evento $evento, Atividade $atividade, User $user){

		$modelo = $evento->certificado;
		//Tratar o texto
		$conteudo = self::trataConteudo($modelo->texto,$user, $atividade);

		$certificado = CertificadoEmitido::where([
			'user_id'=> $user->id,
			'atividade_id' =>$atividade->id
		])->first();

		$chave = $certificado->chave;
		$arquivoRenderizado = view('certificados.certificado-emitido', compact('modelo', 'conteudo', 'chave'))->render();

		$pdf = self::geraCertificado($arquivoRenderizado);
		$titulo = $user->name . ".pdf";
		$pdf->stream($titulo , ["Attachment" => false]);
	}
}

