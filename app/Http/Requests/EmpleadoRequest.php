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
     * Get the validation rules that apply to the request.
     *
     * @return array
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

    public function messages()
{
    return [
        'codigo.required'             => 'El código es requerido.',
        'nombre.required'             => 'El nombre es requerido.',
        'nombre.regex'                => 'Este campo solo acepta letras y guiones.',
        'apellido_paterno.required'   => 'El apellido paterno es requerido.',
        'apellido_materno.required'   => 'El apellido materno es requerido.',
        'correo_electronico.required' => 'El correo electrónico es requerido.',
        'correo_electronico.email'    => 'El correo electrónico es invalido.',
    ];
}

}
