<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['codigo', 'nombre','apellido_paterno','apellido_materno','correo_electronico','tipo_contrato','estado','estatus'];

}
