<div>
    {{$cursoId}}
    <select name="cliente_id[]" class="form-control form-select p-1" id="autoSizingSelect" multiple>
        <option selected>Escoge una opción</option>
        @foreach($asistencias as $asistencia)
        <option value="{{$asistencia->cliente->id}}">{{$asistencia->cliente->nombre}}</option>

        @endforeach

    </select>
</div>