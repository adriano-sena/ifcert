@extends('layouts/layout')

@section('titulo')
    {{$evento->titulo}}
@endsection

@section('conteudo')

    <section id="imagem-principal">
        <img src="..." class="img-fluid" alt="Responsive image">
    </section>
    

    <section class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{$evento->titulo}}</h1>
        <p class="lead">
            {{$evento->subtitulo}} <br>
            {{$evento->descricao}} <br>
            Local : {{$evento->local}} <br>
            Data:  {{$evento->data}} <br>
            Contato: {{$evento->contato}} <br>
            Organizador: {{$evento->organizador}} 
        </p>
        </div>
    </section>

    <section id="cards-atividades">
    {{-- @foreach ($eventos as $evento)
    <article class="card borda-cor-especial card-largura mt-5">
        <img src="src/img/receita-abacate.jpg" class="card-img-top card-imagem-posicao" alt="Imagem da Atividade">
        <div class="card-body">
        <h5 class="card-title">{{$evento->titulo}}</h5>
        <p class="card-text">{{$evento->descricao}}</p>
          <a href="#" class="btn btn-cor-especial">Inscreva-se</a>
        </div>
      </article>
    </section>
    @endforeach --}}
@endsection