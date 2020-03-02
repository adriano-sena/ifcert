<?php

use Illuminate\Database\Seeder;
use \App\Evento;
use \App\Atividade;

class EventoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Cria 50 eventos e a cada evento cria uma atividade relacionada a ele
        
        factory(\App\Evento::class, 50)->create()->each(function ($evento) {
            $evento->atividades()->save(factory(\App\Atividade::class)->make());
        });
    }
}
