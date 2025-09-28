<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['empleados']=Empleado::paginate(5);


        return view('empleado.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $empleado = new Empleado(); // objeto vacío
        return view('empleado.create', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       // $datosEmpleado = request()->all();
       $datosEmpleado = request()->except('_token');

       if($request->hasFile('Foto')){
        $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
       }

       Empleado::insert($datosEmpleado);
        return response()->json($datosEmpleado);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * ACCEDER A ESTE FORM CUANDO EL EMPLEADO HGA CLICK.
     */
   public function edit($id)
{
    // empleado
    $empleado = Empleado::findOrFail($id);

    return view('empleado.edit', compact('empleado'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $datosEmpleado = request()->except('_token', '_method');

        // ALMACENAR IMAGEN EN CARPETA PROYECTO
        // borrado arriba
          if($request->hasFile('Foto')){
            // parte del borrado
                    // RECUPERANDO INFO
            $empleado=Empleado::findOrFail($id);
            //  A TRAVES DE FOTOGRAFIA CONCATENE Y BORRE
            Storage::delete(('public/'.$empleado->Foto));
            // ACTUALIZAR INFO
        $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
       }


        Empleado::where('id', '=', $id)->update($datosEmpleado);

        // REGRESAR A FORM

    $empleado = Empleado::findOrFail($id);

    return view('empleado.edit', compact('empleado'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        Empleado::destroy($id);
        return redirect('empleado');
    }
}
