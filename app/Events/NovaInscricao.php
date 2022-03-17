<?php

namespace App\Events;

use App\Atividade;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaInscricao
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * @var User
	 */
	public  $usuario;
	/**
	 * @var Atividade
	 */
	public $atividade;


	/**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $usuario, Atividade $atividade)
    {
        //
		$this->usuario = $usuario;
		$this->atividade = $atividade;
	}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
