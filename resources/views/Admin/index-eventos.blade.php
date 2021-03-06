@extends('layouts/layout')

@section('titulo')

	  <div class="jumbotron">
	      <h1>@yield('titulo')</h1>
	  </div>

@endsection

@section('conteudo')

{{-- Adicionar Section com imagem referente à eventos  --}}

  <section id="eventos" class="card-container" class="bg-light pb-5">

    <div class="row">
      @foreach ($eventos as $evento)
			<div class="col-lg-4">
				<div class="card card--white m-4 shadow-lg bg-white rounded" >
					{{-- <img src="..." class="card-img-top" alt="..."> --}}
					<div class="card-body">
					<h5 class="card-title">{{$evento->titulo}}</h5>
					<p class="card-text">{{$evento->descricao}}</p>
					  <hr>
					<a href="{{route('admin.eventos.atividades.index', $evento)}}" class="btn btn-terciary">Acessar</a>
					</div>
				</div>
			</div>
			@endforeach

    </div>
</main>

@endsection
