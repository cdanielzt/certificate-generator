@extends('adminlte::page')

@section('title', 'Asistentes')

@section('content_header')
    <h1>Editar Asistente</h1>
@stop

@section('content')
<form action="/asistentes/{{$asistente->id}}" method="POST">
  @method('PUT')
  @csrf
  <div class="mb-3">
      <label for="" class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" id="nombre" value="{{$asistente->nombre}}">
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="socio" name="socio" {{ ($asistente->socio == 1 ? 'checked' : '')}}> 
      <label class="form-check-label" for="" >Socio Coparmex</label>
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="/asistentes" class="btn btn-secondary">Cancelar</a>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop