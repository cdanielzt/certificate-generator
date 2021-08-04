<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{asset('css/square.css')}}">
    <title></title>
</head>
<body>
    <img src="{{asset('images/logo-coparmex.png')}}" alt="" width="300px" class="my-5">

    
    <div class="otorga">
        <p>{{$reconocimiento->otorga}}</p>
    </div>

    <div class="marquee">
        <p>{{$reconocimiento->tipo}}</p>
    </div>

    <div class="to">
        <p>A</p>
    </div>

    <div class="person">
        <p>{{$reconocimiento->cliente->nombre}}</p>
    </div> 

    <div class="reason">
        <p>{{$reconocimiento->razon}} <b>"{{$reconocimiento->curso->nombre}}"</b>
            llevado a cabo el día <b>{{$reconocimiento->fecha}}</b></p>
    </div>

</body>

    <div class="codigo">
        <p>{{$reconocimiento->codigo}}</p>
    </div>
</html>