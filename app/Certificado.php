<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $fillable = [
        "titulo",
        "layout",
        'imagem',
    ];

    /**
     * Método representando a relação de um certificado e um evento ou atividade
     */
    public function certificavel(){
        return $this->morphTo();
    }
    
}
