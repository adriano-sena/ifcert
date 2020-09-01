<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    //Adicionar o mass assignment
    protected $fillable = [
        'titulo',
        'subtitulo',
        'slug',
        'descricao',
        'mediador',
        'cargaHoraria',
        'vagas',
		'qtd_vagas',
        'local',
        'data'
    ];
    //Adicionar cast e hidden se necessário


     //Relacionamentos


    public function evento(){
        return $this->belongsTo(Evento::class, 'evento_id');
    }

     public function users(){
        //parametros ('classe relacionada', 'chave do modelo ', chave relacionada)
        return $this->belongsToMany(User::class,'inscricao','atividade', 'user')
         ->withPivot(['participou'])
         ->withTimestamps();
    }

	/**
	 * A possui vários certificados emitidos
	 */
    public function certificadoEmitidos(){
		return $this->hasMany(CertificadoEmitido::class);
	}
}
