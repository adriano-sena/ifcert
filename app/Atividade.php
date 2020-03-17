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
        'qtd_vagas',
        'local',
        'data'
    ];
    //Adicionar cast e hidden se necessário


    //Método de relação
    public function evento(){
        return $this->belongsTo(Evento::class, 'evento_id');
    }

}
