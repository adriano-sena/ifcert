<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    
    //Atributos que podem ser preencnidos de forma massiva
    protected $fillable = [
        'titulo', 
        'subTitulo',
        'slug',
        'descricao',
        'imagem',
        'local',
        'data_inicio',
        'data_fim',
        'organizador',
        'telefone'
    ];

    //Adicionar Método Has Many para relacionamento com atividade

    public function atividades(){
        
        return $this->hasMany(Atividade::class);
    }
}
