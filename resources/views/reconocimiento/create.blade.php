@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
@stop

@section('content')
    <main class="d-flex align-items-center">
        <div class="container">
          <form action="{{route('reconocimientos.store')}}" class="row g-3" id="formulario" method="POST">
            @csrf
            <div id="wizard">
                <h3>Seleccionar Curso</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Paso 1</h5>
                    <h2 class="section-heading">Seleccionar Curso </h2>
                    <p>Recuerda que siempre puedes <a href="{{route('cursos.create')}}">añadir uno nuevo</a>.</p>
                    <div class="purpose-radios-wrapper">

                        @foreach ($cursos as $curso)
                            <div class="purpose-radio">
                                <input type="radio" name="curso" id="curso-{{ $curso->id }}"
                                    class="purpose-radio-input " value="{{ $curso->id }}">
                                <label for="curso-{{ $curso->id }}" class="purpose-radio-label course">
                                  
                                   @if($curso->imagen)
                                   <img src="{{ asset($curso->imagen) }}" alt="branding"
                                   class="img-thumbnail rounded mx-auto d-block curso-img" border="0">
                                   @else
                                   <img src="{{ asset('images/cursos/default-course-img.jpg') }}" alt="branding"
                                   class="img-thumbnail rounded mx-auto d-block curso-img" border="0">
                                   @endif
                                   <span class="label-text my-2 mx-2 text-center">{{ $curso->nombre }}</span>
                                </label>
                            </div>
                        @endforeach
                              {{ $cursos->links() }}
                    </div>

                </section>
                <h3>Seleccionar Diseño</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Paso 2</h5>
                    <h2 class="section-heading">Selecciona un diseño</h2>
                    <p>El diseño que tendrán todos los reconocimientos de los asistentes al curso.</p>

                    <div class="purpose-radios-wrapper">
                        @foreach($designs as $design)
                          <div class="purpose-radio">
                              <input type="radio" name="design" id="design-{{ $design->id }}"
                                  class="purpose-radio-input" value="{{ $design->id }}">
                              <label for="design-{{ $design->id }}" class="purpose-radio-label">
                                
    
                                 <img src="{{ asset($design->imagen) }}" alt="branding"
                                 class="img-thumbnail rounded mx-auto d-block curso-img" border="0">
    
           
                                 <span class="label-text my-2 mx-2 text-center">{{$design->name}}</span>
                              </label>
                          </div>
                          @endforeach
                  </div>
                </section>

                <h3>Configura el texto</h3>
                <section>
                  <h5 class="bd-wizard-step-title">Paso 3</h5>
                  <h2 class="section-heading">Configura el texto</h2>
                  <p>Modifica el texto que contendrá el reconocimiento.</p>

                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif

                    <label for="" class="form-label">COPARMEX Costa de Chiapas</label>
                   
                    <div class="col-md-12">
                      <label for="" class="form-label">Otorga</label>
                      <input type="text" name="otorga" class="form-control" id="otorga" value="{{ old('otorga')}}" placeholder="Otorga el presente">
                    </div>

                    <div class="col-md-12">
                      <label for="" class="form-label">Tipo de documento</label>
                      <input type="text" name="tipo" class="form-control" id="tipo" value="{{ old('tipo')}}" placeholder="Reconocimiento">
                    </div>

                    <div class="col-12 my-2">
                      <label for="" class="form-label">A</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck" name="todos_clientes">
                        <label class="form-check-label" for="inlineFormCheck">
                          Todos los asistentes
                        </label>
                      </div>
            
                    </div>

                    <div class="col-12">
                      <select name="cliente_id" class="form-control form-select p-1"  id="autoSizingSelect">
                        <option selected>Escoge un asistente</option>
                        @foreach($asistencias as $asistencia)
                          @if($asistencia->curso->id == 4)
                        <option  value="{{$asistencia->cliente->id}}">{{$asistencia->cliente->nombre}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-12">
                      <label for="" class="form-label">Razón</label>
                      <input type="text" name="razon" class="form-control" id="razon" value="{{ old('razon')}}" placeholder="Por su destacada participación en la ponencia">
                    </div>



                  <div class="col-md-12">
                    <label for="" class="form-label">Nombre del taller o curso</label>
                    <input type="text" name="nombre_curso" class="form-control" id="curso" value="Nombre del taller" placeholder="Por su destacada participación y desempeño en el taller">
                  </div>
                  <div class="col-md-12">
                    <label for="" class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" id="fecha">
                  </div>
                  <input type="submit" class="btn btn-success" value="Subir" id="btn-submit">
      

                </form>
                </div>
                </section>
            </div>
        </div>
    </main>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/bd-wizard.css') }}">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('js/bd-wizard.js') }}"></script>

    <script>

      var curso =( function(el){
        return{
          set nombre(v){
            el.value= v;
          },
          get nombre(){
            return el.value;
          }
        };
      })(document.getElementById("curso"));


      $('.course').click( function () {
        console.log(this);
        var texto = $(this).find('span').text();
  
        console.log(texto);
        curso.nombre = texto;
      });

      //Fecha actual
      var today = new Date();

      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

      if(dd<10) {
          dd = '0'+dd
      } 

      if(mm<10) {
          mm = '0'+mm
      } 

      // today = yyyy + '/' + mm + '/' + dd;
       today = yyyy + '-' + mm + '-' + dd;

      console.log(today);
      document.getElementById('fecha').value = today;

    </script>

 
@stop
