@extends('adminlte::page')

@section('title', 'Reconocimientos')

@section('content_header')
    <div class="container-xxl mx-3">
        <h1>Ver Curso</h1>
    </div>
@stop

@section('content')

    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-sm-6 col-12 my-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between px-md-1">
                                                <div>
                                                    <h3 class="text-success">{{ $asistencia }}</h3>
                                                    <p class="mb-0">Asistentes</p>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="far fa-user text-success fa-3x"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button id="botonModal" type="button" class="btn btn-success" style="width: 100%"
                                        data-bs-toggle="modal" data-bs-target="#modal">+ Agregar Asistentes</button>
                                </div>
                                <div class="col-xl-8 col-sm-6 col-12 my-3">
                                    <div class="card">
                                        <div class="card-body">

                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Nombre
                                                        </th>
                                                        <th>

                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($curso->asistenciasCurso as $asistenciaCurso)
                                                        <tr>
                                                            <td>{{ $asistenciaCurso->cliente->nombre }}</td>
                                                            <td class="text-right">
                                                                <form
                                                                    action="{{ route('asistenciaCursos.destroy', $asistenciaCurso->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button href="/cursos/{{ $curso->id }}"
                                                                        class="btn btn-light btn-sm" type="submit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-trash" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                            <path fill-rule="evenodd"
                                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>{{-- row in card body --}}
                        </div>{{-- card body --}}
                    </div> {{-- card --}}
                </div>{{-- Div col-lg-8 --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="my-3 text-center">
                                <h4>{{ $curso->nombre }}</h4>
                            </div>
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset($curso->imagen) }}" alt="Imagen del curso" class=" bg-gray"
                                    width="90%">
                            </div>
                        </div>
                    </div>
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
                            <form action=" /cursos/{{ $curso->id }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <h6 class="form-label">Nombre Completo</h6>
                                    <input type="text" class="form-control" value="{{ $curso->nombre }}" name="nombre">
                                </div>
                                <div class="mb-3">

                                    <h6 class="form-label">Ponente</h6>
                                    <input type="text" class="form-control" value="{{ $curso->ponente }}" name="ponente">

                                </div>
                                <div class="mb-3">
                                    <h6 class="form-label">Descripción</h6>
                                    <textarea type="text" class="form-control" value="{{ $curso->descripcion }}"
                                        name="descripcion">
                                    </textarea>
                                </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="submit" class="btn btn-primary px-4" value="Guardar Cambios">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> {{-- Div row --}}

    </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Asistencia a Curso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('asistenciaCursos.store') }}" method="POST" id="agregarClientes">
                    <div class="modal-body">

                        @csrf
                        <table class="table table-stripped" id="clientes">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="width: 5%">
                                        id
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="cliente_id[]" value="{{ $cliente->id }}">
                                        </td>
                                        <td>{{ $cliente->id }}</td>
                                        <td>{{ $cliente->nombre }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <input type="hidden" name="curso_id" value="{{ $curso->id }}">

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar" id="guardar">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#clientes').DataTable({
                pageLength: 10,
                lengthMenu: [10, 15, 20, 50, 100],
                "order": [
                    [1, "desc"]
                ],
            });


            $('#clientes tbody').on('click', 'tr', function() {
                //cuando se de click a una fila
                $(this).toggleClass('selected'); //Se agregara la clase selected

                var checkbox = $(this).find("td").find(
                "input[type=checkbox]"); //Se guarda el checkbox de la fila
                console.log($(this).hasClass('selected'));

                if (!($(this).hasClass('selected'))) { //Si esta seleccionado
                    checkbox.prop("checked", false); //se deseleccionara
                } else { //si no esta seleccionado
                    checkbox.prop("checked", true); // se seleccionará
                }

                console.log('Checkbox seleccionado', checkbox.prop("checked"));
            });



            $('#guardar').click(function() {


                var theArray = [];
                for (let i = 0; i < table.rows('.selected').data().length; i++) {
                    theArray.push(table.rows('.selected').data()[i][1]);
                }

                console.log(theArray);

            });

            $('#agregarClientes').on('submit', function(e) {
                var $form = $(this);

                // Iterate over all checkboxes in the table
                table.rows().nodes().to$().find('input[type="checkbox"]').each(function() {
                    var cont = 1;
                    console.log(cont++);
                    // If checkbox doesn't exist in DOM
                    if (!$.contains(document, this)) {
                        // If checkbox is checked
                        if (this.checked) {
                            // Create a hidden element 
                            console.log('seleccionado ', this.value);
                            $form.append(
                                $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', this.name)
                                .val(this.value)
                                .prop("checked", true)
                            );
                        }
                    }
                });
            });

        });
    </script>
@stop
