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

    
      
      <div class="row">
        @foreach ($atividades as $atividade)
          <div class="col-lg-4">
            <div class="card card--white m-4 shadow-lg bg-white rounded" >
              {{-- <img src="..." class="card-img-top" alt="..."> --}}
              <div class="card-body">
              <h5 class="card-title">{{$atividade->titulo}}</h5>
              <p class="card-text">{{$atividade->descricao}}</p>
              <p class="card-text"><i class="fas fa-map-marker-alt "></i>  {{$atividade->local}}</p>
              <p class="card-text"><i class="fas fa-calendar-week "></i>  {{$atividade->data}}</p>
				<hr>

				<form action="{{route('eventos.atividades.inscricao', ['atividade' => $atividade->id])}}" method="POST">
					@csrf
					<button type="submit" class="btn btn-terciary" @guest disabled @endguest>
						@guest
							Faça o login
						@else
							Inscrever
						@endguest
					</button>
				</form>

              </div>
            </div>
          </div>
        @endforeach
    
</main>

@endsection
