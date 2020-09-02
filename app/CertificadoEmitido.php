<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CertificadoEmitido
 * @package App
 *
 * Representa um certificado emitido no sistema
 * Contem o id de um usuário e o id da atividade
 */

class CertificadoEmitido extends Model
{
    //

	protected $fillable = ['user', 'atividade' , 'chave'];

	public function user(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function atividade(){
		return $this->belongsTo(Atividade::class, 'atividade_id');
	}
}
