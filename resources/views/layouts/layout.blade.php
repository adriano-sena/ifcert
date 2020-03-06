<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="{{asset('site/bootstrap.css')}}">
  <title>IF-CERT</title>
</head>
<body>
  
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
  <a class="navbar-brand" href=#>IfCert</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">IF-CERT <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">CONTATO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">SOBRE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ÁREA ADMINISTRATIVA</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<div class="container">
  <div class="jumbotron">
      <h1>@yield('titulo')</h1>
  </div>

  @yield('conteudo')
</div>

@yield('rodape')

<script src="{{asset('site/jquery.js')}}"></script>
</body>
</html>