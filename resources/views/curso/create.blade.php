@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
  <div class="container-xxl mx-3">
    <h1>Nuevo Curso</h1>
  </div>
@stop

@section('content')

<div class="container">
  <div class="main-body">

    <form action="{{ route('cursos.store')}}" method="POST" enctype="multipart/form-data">

      <div class="row">
          <div class="col-lg-4">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <h4>Imagen del Curso</h4>
                          <img src="https://png.pngitem.com/pimgs/s/150-1503945_transparent-user-png-default-user-image-png-png.png" alt="Imagen del curso" class=" bg-gray" width="110">
                          <div class="mt-3">
                            <label for="" class="form-label">Subir archivo</label>
                            <input type="file" name="imagen" class="form-control" id="imagen">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
         <div class="col-lg-8">
            <div class="card">
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


                @csrf

                <div class="mb-3">
                    <label for="" class="form-label">Nombre del Curso</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre')}}">
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Ponente</label>
                    <input type="text" name="ponente" class="form-control" id="ponente" value="{{ old('ponente')}}">
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Descripción</label>
                    <textarea type="text" name="descripcion" class="form-control" id="descripcion" value="{{ old('descripcion')}}">
                    </textarea>
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Agregar</button>
                  <a href="/cursos" class="btn btn-danger">Cancelar</a>
            

              </div>
              </div>
  </div>
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