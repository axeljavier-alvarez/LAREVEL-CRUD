MOSTRAR LISTA DE EMPLEADOS
<table class="table table-light">
    <thead class="thead-light">
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
    <tbody>
        @foreach ( $empleados as $empleado )

        <tr>
            <td>{{ $empleado ->id }}</td>
<!-- agregar esta imagen -->
 <td>
    <img src="{{ asset('storage').'/'.$empleado->Foto }}" width="100">
 </td>
<!--            <td>{{ $empleado ->Foto }}</td>
 -->
            <td>{{ $empleado ->Nombre }}</td>
            <td>{{ $empleado ->ApellidoPaterno }}</td>
            <td>{{ $empleado ->ApellidoMaterno }}</td>
            <td>{{ $empleado ->Correo }}</td>
            <td>
                <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}">
                    Editar
                </a>
                |
                    <!-- BOTON DE ELIMINAR -->
                <form action="{{  url('/empleado/'.$empleado->id) }}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                </form>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>
