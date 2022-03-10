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
                background-image: url("{{asset('storage/'. $certificado->background)}}");
                /* Center and scale the image nicely */
                /* background-position: center;
                background-repeat: no-repeat;
                background-size: 100%; */

        }

		.content{
			margin: 20px;
		}
    </style>
</head>
<body>
	<div class="content">
		{!! nl2br($certificado->texto) !!}
	</div>


</body>
</html>
