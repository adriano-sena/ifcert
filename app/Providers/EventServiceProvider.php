<?php

namespace App\Providers;

use App\Events\NovaInscricao;
use App\Events\NovoUsuario;
use App\Listeners\EnviarEmailCadastro;
use App\Listeners\NovaInscricaoEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
		NovoUsuario::class =>[
			EnviarEmailCadastro::class
		],
		NovaInscricao::class => [
			NovaInscricaoEmail::class
		]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
