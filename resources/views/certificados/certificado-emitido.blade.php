<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado</title>

    <style>
        html{
            margin: 0;
			height: 100%;
        }

        body{
                background-position: center center;
                background-repeat: no-repeat;
                background-image: url({{$certificado->background}});
        }

		.chave{
			position: absolute;
			position: absolute;
			bottom: 15%;
			right: 10%;
			font-family: "Times New Roman";
			font-size: 1em;

		}
    </style>
</head>
<body>
        {!! nl2br($certificado->texto) !!}
		<div class="chave">
			Chave: 123121212121 <br/>
			ifcert.portoinforma.com.br
		</div>
</body>
</html>


Certificamos que #nome participou da atividade #atividade na data #data com cargaHorária de #horas
