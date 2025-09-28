@extends('layouts.app')

@section('content')
<div class="container">



@if(Session::has('mensaje'))
{{ Session::get('mensaje') }}
@endif

<a href="{{  url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>
<table class="table table-bordered">
    <thead class="table-primary text-center">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ( $empleados as $empleado )

        <tr>
            <td>{{ $empleado ->id }}</td>
<!-- agregar esta imagen -->
 <td>
    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100">
 </td>
<!--            <td>{{ $empleado ->Foto }}</td>
 -->
            <td>{{ $empleado ->Nombre }}</td>
            <td>{{ $empleado ->ApellidoPaterno }}</td>
            <td>{{ $empleado ->ApellidoMaterno }}</td>
            <td>{{ $empleado ->Correo }}</td>
            <td>
                <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}"
                method="post" class="btn btn-warning">
                    Editar
                </a>
                |@csrf
                    <!-- BOTON DE ELIMINAR -->
                <form action="{{  url('/empleado/'.$empleado->id) }}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                </form>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>
</div>

@endsection

