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
        $datos['empleados']=Empleado::paginate(1);


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

        // validacion de longitud de campos
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];
        // error
        $mensaje=[
            'required'=>'El : atributo es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        // VALIDACION
        $request->validate($campos, $mensaje);

       // $datosEmpleado = request()->all();
       $datosEmpleado = request()->except('_token');

       if($request->hasFile('Foto')){
        $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
       }

       Empleado::insert($datosEmpleado);
      //return response()->json($datosEmpleado);
      return redirect('empleado')->with('mensaje', 'Empleado agregado con exito');
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
    // VALIDACIONES

    // validacion de longitud de campos
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',

        ];
        // error
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

            if ($request->hasFile(key: 'Foto')) {
            $campos=[ 'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=[
            'required'=>'El : atributo es requerido',
            'Foto.required'=>'La foto es requerida'
            ];
            }
        // VALIDACION
        $request->validate($campos, $mensaje);

    $datosEmpleado = request()->except('_token', '_method');

    if ($request->hasFile(key: 'Foto')) {
        $empleado = Empleado::findOrFail($id);

        // Eliminar foto anterior si existe
        if ($empleado->Foto && Storage::disk('public')->exists($empleado->Foto)) {
            Storage::disk('public')->delete($empleado->Foto);
        }

        // Guardar nueva foto
        $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
    }

    Empleado::where('id', '=', $id)->update($datosEmpleado);

    $empleado = Empleado::findOrFail($id);

    // return view('empleado.edit', compact('empleado'));
    return redirect('empleado')->with('mensaje', 'Empleado Modificado');

}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $empleado = Empleado::findOrFail($id);

    if ($empleado->Foto && Storage::disk('public')->exists($empleado->Foto)) {
        Storage::disk('public')->delete($empleado->Foto);
    }

    Empleado::destroy($id);

    // return redirect('empleado');
    // MOSTRAR MENSAJE
    return redirect('empleado')->with('mensaje', 'Empleado Borrado');
}

}
