<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  {{-- fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,900|Ubuntu:400,700&display=swap" rel="stylesheet">

  {{-- Icons --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">


  <link rel="stylesheet" href="{{asset('site/bootstrap.css')}}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="{{asset('home/home.css')}}">


  <title>IF-CERT</title>
</head>
<body>

<header class="nav-container">
  @include('layouts.navbar-blue')
</header>

<div class="container">
{{--  <div class="jumbotron">--}}
{{--      <h1>@yield('titulo')</h1>--}}
{{--  </div>--}}

  @include('flash::message')
  @yield('conteudo')
</div>

@yield('rodape')

<script src="{{asset('site/jquery.js')}}"></script>
<script src="{{asset('site/bootstrap.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
@yield('script')
</body>
</html>
