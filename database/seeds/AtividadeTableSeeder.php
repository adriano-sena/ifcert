<?php

use Illuminate\Database\Seeder;
use \App\Evento; 

class AtividadeTableSeeder extends Seeder
{
    /**
     * Uma atividade só pod eexistir se for atrelada a um evento
     *
     * @return void
     */
    public function run()
    {

        

        // $eventos = Evento::all();

        // foreach($eventos as $evento)
        // {
        //     $evento->atividades()->save(factory(\App\Atividade::class)->make());
        // }
    }
}
