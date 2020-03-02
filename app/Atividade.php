<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    //Adicionar o mass assignment
    //Adicionar cast e hidden se necessário


    //Método de relação
    public function evento(){
        return $this->belongsTo(Evento::class, 'evento_id');
    }

}
