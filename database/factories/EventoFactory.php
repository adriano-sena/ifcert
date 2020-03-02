<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Evento::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'subTitulo' => $faker->name,
        'slug' =>  $faker->slug,
        'descricao' => $faker->sentence,
        'local' => $faker->name,
        'data' => $faker->date(),
        'organizador' => $faker->name, 
        'telefone' => $faker->phoneNumber
    ];
});
