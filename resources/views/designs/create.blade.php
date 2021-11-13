@extends('adminlte::page')

@section('title', 'Diseños')

@section('content_header')
  <div class="container-xxl mx-3">
    <h1>Nuevo Diseño</h1>
  </div>
@stop

@section('content')

<div class="container">
  <div class="main-body">

    <form action="{{ route('diseños.store')}}" method="POST" enctype="multipart/form-data">

      <div class="row">
          <div class="col-lg-4">
              <div class="card">
                  <div class="card-body">
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <div class="d-flex flex-column align-items-center text-center">
                        <h4>Imagen</h4>
                          <img src="https://png.pngitem.com/pimgs/s/150-1503945_transparent-user-png-default-user-image-png-png.png" alt="Imagen del curso" class=" bg-gray" width="110">
                          <div class="mt-3">
                            <label for="" class="form-label">Seleccionar archivo</label>
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
                    <label for="" class="form-label">Nombre del diseño</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre')}}">
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