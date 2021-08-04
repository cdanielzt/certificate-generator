@extends('adminlte::page')

@section('title', 'Asistentes')

@section('content_header')
    <h1>Vista index</h1>
@stop

@section('content')
    
<a href="asistentes/create" class="btn btn-success my-3">Nuevo asistente</a>

<table id="asistentes" class="table table-stripped table-bordered shadow-lg  mt-4">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Socio</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($asistentes as $asistente)
            <tr>
                <td>{{  $asistente->id  }}</td>
                <td>{{  $asistente->nombre  }}</td>
                <td>
                        @if( $asistente->socio == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>
                        @endif
                </td>
                <td>
                    <form action="{{ route('asistentes.destroy',$asistente->id) }}" method="POST">
                      
                        <a href="/asistentes/{{$asistente->id}}/edit" class="btn btn-info">Editar</a>
                        @csrf 
                        @method('DELETE')
                        <button href="/asistentes" class="btn btn-danger" type="submit">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#asistentes').DataTable();
        } );
    </script>
@stop