<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Http\Requests\EmpleadoRequest;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{

        
    /**
     * index
     * Consulta la información en la base de datos y la retorna hacia la vista
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $search = $request->search;

        if($search == ''){
            $empleados = Empleado::orderBy('nombre', 'ASC')
                ->where('estatus', 1)
                ->paginate(10);
        }else{
            $empleados = Empleado::orderBy('nombre', 'ASC')
                ->where('estatus', 1)
                ->where('nombew', 'like' , '%' . $search .'%')
                ->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $empleados->total(),
                'current_page' => $empleados->currentPage(),
                'per_page'     => $empleados->perPage(),
                'last_page'    => $empleados->lastPage(),
                'from'         => $empleados->firstItem(),
                'to'           => $empleados->lastItem(),
        ],
        'empleados' => $empleados
        ];
    }

        
    /**
     * store
     * Recibe la información de la petición y crea un nuevo registro en la base de datos
     * @param  mixed $request
     * @return void
     */
    public function store(EmpleadoRequest $request)
    {
        if (!$request->ajax()) return redirect('/');
        Empleado::create($request->all());
    }

        
    /**
     * update
     * Recibe la información de la petición y actualiza el registro correspondiente en la base de datos
     * @param  mixed $request
     * @return void
     */
    public function update(EmpleadoRequest $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->fill($request->all())->save();
    }
         
    /**
     * estados
     * Se encarga de cambiar los campos <<estado>> y <<estatus>> de los registros en la base de datos
     * @param  mixed $request
     * @return void
     */
    public function estados(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->fill($request->all())->save();
    }

}
