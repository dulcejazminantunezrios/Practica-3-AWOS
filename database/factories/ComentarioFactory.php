<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\comentario;
use Faker\Generator as Faker;

$factory->define(comentario::class, function (Faker $faker) {
    return [
        'titulo'=>$faker->unique()->sentence(3),
        'cuerpo'=>$faker->text(100),
        'producto_id'=>$faker->numberBetween(1,100),
        'persona_id'=>$faker->numberBetween(1,100)
    ];
});