<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Http\Requests\EmpleadoRequest;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        if (!$request->ajax()) return redirect('/');
        Empleado::create($request->all());
        dd($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

}
