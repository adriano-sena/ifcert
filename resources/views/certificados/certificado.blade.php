<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado</title>

    <style>
        html{
            margin: 0;
        }
		
        body{
                background-position: center center;
                background-repeat: no-repeat;
                background-image: url({{$certificado->background}});
                /* Center and scale the image nicely */
                /* background-position: center;
                background-repeat: no-repeat;
                background-size: 100%; */

        }
    </style>
</head>
<body>
        {!! nl2br($certificado->texto) !!}
</body>
</html>
