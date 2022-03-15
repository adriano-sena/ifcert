<?php

namespace App\Listeners;

use App\Events\NovoUsuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailCadastro
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
     * @param  NovoUsuario  $event
     * @return void
     */
    public function handle(NovoUsuario $event)
    {
        $user = $event->usuario;
		$email = new \App\Mail\EmailCadastro(
			$user->name
		);
		$email->subject("Bem vindo ao Ifcert");
		Mail::to($user)->send($email);

    }
}
