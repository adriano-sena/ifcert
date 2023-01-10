<?php

namespace App\Listeners;

use App\Events\NovaInscricao;
use App\Mail\EmailInscricao;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NovaInscricaoEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaInscricao  $event
     * @return void
     */
    public function handle(NovaInscricao $event)
    {
        $usuario = $event->usuario;
        $atividade = $event->atividade;

         $email = new EmailInscricao($usuario->name, $atividade->titulo, $atividade->data);
         $email->subject("Ifcert: Cadastro atividade ". $atividade->titulo);
		 Mail::to($usuario)->send($email);

    }
}
