<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empleado;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Empleado::class, function (Faker $faker) {
    return [
        'codigo'             => $faker->name,
        'nombre'             => $faker->name,
        'apellido_paterno'   => $faker->lastName,
        'apellido_materno'   => $faker->lastName,
        'correo_electronico' => $faker->unique()->safeEmail,
        'tipo_contrato'      => Str::random(10),
    ];
});
