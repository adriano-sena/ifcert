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
                background-image: url({{$modelo->background}});
        }

		.chave{
			position: absolute;
			position: absolute;
			bottom: 15%;
			right: 10%;
			font-size: 1em;
			font-family: "Times New Roman";
		}

		.content{
			margin: 20px;
		}
    </style>
</head>
<body>
		<div class="content">
			{!! nl2br($conteudo) !!}
		</div>

		<div class="chave">
			Chave: {{$chave}} <br/>
			ifcert.portoinforma.com.br/autenticacao
		</div>
</body>
</html>
