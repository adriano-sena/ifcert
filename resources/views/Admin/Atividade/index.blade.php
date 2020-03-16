@extends('layouts/layout')

@section('titulo')
    <h1>Página de Atividades</h1>
@endsection


@section('conteudo')

{{-- Adicionar Carousel das atividades (Imagem e Descrição)  --}}

<section id="titulo">
    <div class="text-center py-5 px-2">
      <h1 class="">Atividades </h1>
      <p class="text-secondary">Cadastre-se nas atividades do seu interesse </p>
    </div>
  </section>

  <section id="ativivades" class="bg-light pb-5">

    <div class="container d-flex flex-wrap justify-content-md-around justify-content-center">
      
    @foreach ($atividades as $atividade)
    <article class="card borda-cor-especial card-largura mt-5">
        <img src="#" class="card-img-top card-imagem-posicao" alt="Imagem do Evento">
        <div class="card-body">
        <h5 class="card-title">{{$atividade->titulo}}</h5>
        <p class="card-text">{{$atividade->descricao}}</p>
          <a href="#" class="btn btn-cor-especial">Inscrever-se</a>
        </div>
      </article>
    @endforeach

    </div>   
</main>

@endsection
