@extends('adminlte::page')

@section('title', 'Diseños')

@section('content_header')
    <div class="container-xxl mx-2">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Diseños</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Añadir nuevo diseño
            </button>
        </div>
    </div>

@stop

@section('content')

    <div class="container mx-2 pb-3">
        <div class="d-flex flex-row mb-3">
            @foreach ($designs as $design)
                <div class="card mr-5" style="width: 18rem;">
                    @if ($design->imagen)
                        <img src="{{ asset($design->imagen) }}" alt="branding"
                            class="img-thumbnail rounded mx-auto d-block curso-img" border="0">
                    @else
                        <img src="{{ asset('images/cursos/default-course-img.jpg') }}" alt="branding"
                            class="img-thumbnail rounded mx-auto d-block curso-img" border="0">
                    @endif
                    <div class="card-body d-flex flex-row justify-content-between">
                        <h5 class="card-title row">{{ $design->nombre }}</h5>
                        <div>
                            <form action="{{ route('designs.destroy', $design->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <a href="/designs/{{ $design->id }}/edit" class="btn btn-info btn-sm"">
                                <svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                                <button href="/designs" class="btn btn-danger btn-sm" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $designs->links() }}


    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('designs.store') }}" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <h4>Imagen</h4>
                                            <img src="https://png.pngitem.com/pimgs/s/150-1503945_transparent-user-png-default-user-image-png-png.png"
                                                alt="Imagen del curso" class=" bg-gray" width="200px">
                                            <div class="mt-3">
                                                <label for="" class="form-label">Seleccionar archivo</label>
                                                <input type="file" name="imagen" class="form-control" id="imagen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
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
                                        <input type="text" name="nombre" class="form-control" id="nombre"
                                            value="{{ old('nombre') }}">
                                    </div>



                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <a href="/designs" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                </div>
                </form>

            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@stop
