<!--
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" value="{{ $empleado->Nombre }}" id="Nombre">
<br>
<label for="ApellidoPaterno">Apellido Paterno</label>
<input type="text" name="ApellidoPaterno" value="{{ $empleado->ApellidoPaterno }}" id="ApellidoPaterno">
<br>
<label for="ApellidoMaterno">Apellido Materno</label>
<input type="text" name="ApellidoMaterno" value="{{ $empleado->ApellidoMaterno }}" id="ApellidoMaterno">
<br>
<label for="Correo">Correo</label>
<input type="email" name="Correo" value="{{ $empleado->Correo }}" id="Correo">
<br>
<label for="Foto">Foto</label>
{{ $empleado->Foto }}
<img src="{{ asset('storage').'/'.$empleado->Foto }}" width="100">
<input type="file" name="Foto" value=""  id="Foto">
<br>
<input type="submit" value="Guardar datos">
<br>
 -->

<h1> {{ $modo }} empleado</h1>

@if (count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
@foreach ( $errors->all() as $error)

<li>{{ $error }}</li>

@endforeach
    </ul>
</div>
@endif
<!-- NUEVO DIV -->
 <div class="form-group">
<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name="Nombre" value="{{ isset($empleado->Nombre)? $empleado->Nombre:old('Nombre')}}" id="Nombre">
</div>

 <div class="form-group">
    <label for="ApellidoPaterno">Apellido Paterno</label>
<input type="text" class="form-control" name="ApellidoPaterno" value="{{ isset( $empleado->ApellidoPaterno)
?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}" id="ApellidoPaterno">
</div>

<div class="form-group">
<label for="ApellidoMaterno">Apellido Materno</label>
<input type="text" class="form-control" name="ApellidoMaterno"
value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}" id="ApellidoMaterno">
</div>

<div class="form-group">
<label for="Correo">Correo</label>
<input type="email" class="form-control" name="Correo"
value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" id="Correo">
</div>
<div class="form-group">

<label for="Foto"></label>
<!-- {{ $empleado->Foto }}
 -->
@if(isset($empleado->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100">
@endif
<input type="file" class="form-control" name="Foto" value=""  id="Foto">
</div>
<br>
<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('empleado/') }}">Regresar</a>


