<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    // Contiene los campos de la tabla que pueden ser rellenados con mass assigned
    protected $fillable = ['codigo', 'nombre','apellido_paterno','apellido_materno','correo_electronico','tipo_contrato','estado','estatus'];

}
