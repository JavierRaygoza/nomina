<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empleado;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Empleado::class, function (Faker $faker) {
    return [
        'codigo'             => Str::random(10),
        'nombre'             => $faker->name,
        'apellido_paterno'   => $faker->lastName,
        'apellido_materno'   => $faker->lastName,
        'correo_electronico' => $faker->unique()->safeEmail,
        'tipo_contrato'      => 'Temporal',
    ];
});
