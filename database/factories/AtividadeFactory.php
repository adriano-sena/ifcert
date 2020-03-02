<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Atividade::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'subtitulo' => $faker->name,
        'slug' =>$faker->slug,
        'descricao'=> $faker->sentence,
        'mediador' =>$faker->name,
        'cargaHoraria'=>$faker->randomNumber(2),
        'local' => $faker->address,
        'data'=> $faker->date()
    ];
});
