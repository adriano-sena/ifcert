<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    
    //Atributos que podem ser preeshcnidos de forma massiva
    protected $fillable = [
        'titulo', 
        'subTitulo',
        'descricao',
        'local',
        'data',
        'organizador',
        'telefone'
    ];

    //Adicionar Método Has Many para relacionamento com atividade

    public function atividades(){
        
        return $this->hasMany(Atividade::class);
    }
}
