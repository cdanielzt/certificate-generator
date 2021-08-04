<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{asset('css/square.css')}}">
    <style>
        body{
            font-family: 'Poppins';
            background-image: url({{ asset($reconocimiento->design->imagen)}});
        }
        
        @font-face {
        font-family: 'Poppins';
        font-weight: normal;
        src: url({{asset('fonts/Poppins-Regular.ttf')}}) format('truetype');
        }

        @font-face {
        font-family: 'Poppins';
        font-weight: bold;
        src: url({{asset('fonts/Poppins-Bold.ttf')}}) format('truetype');
        }
       
    </style>
    <title></title>
</head>
<body>
    <div class="contenido">
    <img src="{{asset('images/logo-coparmex.png')}}" alt="" width="300px" class="logo">

  
        <p class="otorga">{{$reconocimiento->otorga}}</p>
  


        <p class="marquee">{{$reconocimiento->tipo}}</p>



        <p class="to">A</p>


 
        <p class="person">{{$reconocimiento->cliente->nombre}}</p>



        <p class="reason">{{$reconocimiento->razon}} <b>"{{$reconocimiento->curso->nombre}}"</b>
            llevado a cabo el día <b>{{$reconocimiento->fecha}}.</b></p>
 

        <p class="codigo">Código: {{$reconocimiento->codigo}}</p>

        </div>
</body>



</html>