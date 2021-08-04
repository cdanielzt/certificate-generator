<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html" charset=utf-8"/>

    <link rel="stylesheet" href="{{asset('css/square.css')}}">
    <style>
        body{
            width: 100%;
            display: flex;
            justify-content: center;
            background-image: url({{ public_path('/images/design/fondo-circle.jpg')}});
        }
    </style>
    <title>$reconocimiento->codigo</title>

  </head>
  <body>

   <main>

    <img src="{{asset('images/logo-coparmex.png')}}" alt="" width="400px" class="my-5">

    <div class="otorga">
        Otorga el presente
    </div>

    <Div class="marquee">
        Reconocimiento
    </Div>

    <div>
        A
    </div>

    <div class="person">
        Carlos Daniel Zapata Torres
    </div>

    <div class="reason">
        <p style="width: 70%">Por su destacada participación en la ponencia <b>"Cómo vender en Facebook e Instagram"</b>
            llevado a cabo el día <b>23 de julio de 2021</b></p>
    </div>

    <div class="codigo">
            <p class="codigo">Código: CPMX-210730001</p>
    </div>
   </main>
  </body>
</html>