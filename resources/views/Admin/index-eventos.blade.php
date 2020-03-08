@extends('layouts/layout')

@section('titulo')
    <h1>Página de Eventos</h1>
@endsection


@section('conteudo')

{{-- Adicionar Section com imagem referente à eventos  --}}

<section id="titulo">
    <div class="text-center py-5 px-2">
      <h1 class="">Eventos </h1>
      <p class="text-secondary">Veja o que está acontecendo no Campus Ifba eunápolis</p>
    </div>
  </section>

  <section id="eventos" class="bg-light pb-5">

    <div class="container d-flex flex-wrap justify-content-md-around justify-content-center">
      
    @foreach ($eventos as $evento)
    <article class="card borda-cor-especial card-largura mt-5">
        <img src="src/img/receita-abacate.jpg" class="card-img-top card-imagem-posicao" alt="Imagem do Evento">
        <div class="card-body">
        <h5 class="card-title">{{$evento->titulo}}</h5>
        <p class="card-text">{{$evento->descricao}}</p>
          <a href="#" class="btn btn-cor-especial">Acessar Evento</a>
        </div>
      </article>
    @endforeach

    </div>   
</main>

@endsection
