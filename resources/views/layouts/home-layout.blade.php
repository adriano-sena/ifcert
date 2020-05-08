<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IF-Cert</title>

    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,900|Ubuntu:400,700&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">

    {{-- Css --}}
    <link rel="stylesheet" href="{{asset('site/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('home/home.css')}}">


</head>
<body>
    
    @yield('conteudo')


    <script src="{{asset('site/jquery.js')}}"></script>
    <script src="{{asset('site/bootstrap.js')}}"></script>
</body>
</html>