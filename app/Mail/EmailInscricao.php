<?php

namespace App\Mail;

use App\Atividade;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailInscricao extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * @var String
	 */
	public $nome;
	/**
	 * @var String
	 */
	public $atividade;
	/**
	 * @var String
	 */
	public $data;


	/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $nome, String $atividade, String $data)
    {

		$this->nome = $nome;
		$this->atividade = $atividade;
		$this->data = $data;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.user.inscricao');
    }
}
