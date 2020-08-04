<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Lista de Inscritos</title>

	<style>

		@page {
			margin: 100px 25px;
		}

		header {
			position: fixed;
			top: -60px;
			left: 0px;
			right: 0px;
			height: 50px;
			margin-bottom: 50px;

		}

		main{
			margin-top: 50px;
		}

		footer {
			position: fixed;
			bottom: -60px;
			left: 0px;
			right: 0px;
			height: 50px;
		}



		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}

		.text-center{
			text-align: center;
		}
	</style>

</head>
<body>

	<header>
		<table>
			<tr>
				<th colspan="2">{{$evento->titulo}}</th>
				<th>{{$atividade->data}}</th>
				<th>1/1</th>
			</tr>
			<tr>
				<th colspan="4">Lista de Presença - {{$atividade->titulo}} </th>
			</tr>
		</table>
	</header>

	<main>
		<table>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Assinatura</th>
			</tr>
			@foreach($inscritos->sortBy('name') as $inscrito)
				<tr>
					<td>{{$inscrito->name}}</td>
					<td>{{$inscrito->cpf}}</td>
					<td></td>Th3
				</tr>
			@endforeach
		</table>
	</main>

	<footer>
		<table>
			<tr>
				<th class="text-center">Documento emitido via &copy; IFcert - Acesse ifcert.com.br</th>
			</tr>
		</table>
	</footer>

</body>
</html>
