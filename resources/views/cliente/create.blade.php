@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
  <div class="container-xxl mx-3">
    <h1>Nuevo Cliente</h1>
  </div>
@stop

@section('content')
<div class="card mx-3">
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
  <form action="/clientes" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre')}}">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email')}}">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono')}}">
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="socio" name="es_socio">
        <label class="form-check-label" for="" >Socio Coparmex</label>
      </div>
      
      <button type="submit" class="btn btn-primary">Agregar</button>
      <a href="/clientes" class="btn btn-danger">Cancelar</a>
  </form>
</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop