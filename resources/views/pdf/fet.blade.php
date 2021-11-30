<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 0;
        }

        body {
            width: 100%;
            height: 100vh;
            margin: 0 auto;
            font-size: 22px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            text-align: center;
            page-break-after: avoid;
            color: #414141;
            background-image: url('{{$image}}');
            font-family: 'Poppins', Arial, Helvetica, sans-serif;

        }

        .name {
            color: #0071CE;
            font-weight: bold;
            margin-top: 374px;
            margin-bottom: 0;
            margin-left: 70px;
            font-size: 22px;
            text-transform: uppercase;
        }

        .name.fet{
            margin-top: 307px; 

        }

        .codigo {
            margin-top: 335px; 
            font-size: 15px;
            color: #999;
            page-break-after: avoid;
        }

        .codigo.fet{
            margin-top: 390px;
        }

    </style>
    <title></title>
</head>

<body>
    <div class="contenido">
        <p class="name">{{$reconocimiento->cliente->nombre}}</p>
        <p class="codigo">Código: {{$reconocimiento->codigo}}</p>
    </div>
</body>



</html>