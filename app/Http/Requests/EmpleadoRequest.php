<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
   
    /**
     * rules
     * Se enlistas las validaciones que se realizaran para cada campo
     * @return void
     */
    public function rules()
    {
        $rules = [
            'codigo'             => 'required',
            'nombre'             => 'required|regex:/^[A-Za-z- ]+$/',
            'apellido_paterno'   => 'required|regex:/^[A-Za-z- ]+$/',
            'apellido_materno'   => 'required|regex:/^[A-Za-z- ]+$/',
            'correo_electronico' => 'required|email',
        ];
    
        return $rules;
    }
    
    /**
     * messages
     * Ayuda con la personalización de los mensajes que se muestran en el FrontEnd
     * Se utiliza el helper <<trans>> para traer las etiquetas como variables y solo modificar el archivo principal de ser requerido
     * @return void
     */
    public function messages()
    {
        return [
            'codigo.required'             => trans('app.codigo_required'),
            'nombre.required'             => trans('app.nombre_required'),
            'nombre.regex'                => trans('app.nombre_regex'),
            'apellido_paterno.required'   => trans('app.apellido_paterno_required'),
            'apellido_materno.required'   => trans('app.apellido_materno_required'),
            'correo_electronico.required' => trans('app.correo_electronico_required'),
            'correo_electronico.email'    => trans('app.correo_electronico_format'),
        ];
    }

}
