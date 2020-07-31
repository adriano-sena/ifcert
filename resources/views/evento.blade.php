@extends('layouts/layout')

{{--@section('titulo')--}}
{{--    {{$evento->titulo}}--}}
{{--@endsection--}}

@section('conteudo')

    <section id="imagem-principal">
{{--        <img src="..." class="img-fluid" alt="Responsive image">--}}
    </section>


    <section class="jumbotron jumbotron-fluid mt-3">
        <div class="container">
            <h1 class="display-4">{{$evento->titulo}}</h1>
        <p class="lead">
            {{$evento->subtitulo}} <br>
            {{$evento->descricao}} <br>
            Local : {{$evento->local}} <br>
            Período:  {{$evento->data_inicio}} à {{$evento->data_fim}} <br>
            Contato: {{$evento->contato}} <br>
            Organizador: {{$evento->organizador}}
        </p>
        </div>
    </section>

	{{-- Seção cards com eventos --}}
	<section id="eventos" class="container-fluid">

		<div class=" header card w-60 p-3 text-center card--bgOrange shadow-lg rounded">
			<h2 class="header__title--bgWhite">Atividades disponíveis</h2>
		</div>

		<div class="row">
			@foreach ($atividades as $atividade)
				<div class="col-lg-4">
					<div class="card card--white m-3 shadow-lg bg-white rounded" >
						{{-- <img src="..." class="card-img-top" alt="..."> --}}
						<div class="card-body">
							<h5 class="card-title">{{$atividade->titulo}}</h5>
							<p class="card-text">{{$atividade->descricao}}</p>
							<hr>
							<form action="{{route('admin.eventos.atividades.inscricao', ["atividade" => $atividade->id, "user" => Auth::user()])}}" method="post">
								@csrf
								<button type="submit" class="btn btn-terciary">
									Inscrever-se
								</button>
							</form>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</section>
@endsection

@section('script')
	<script>
		const toast = Swal.mixin({
			toast:true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		})

		@if(session()->has('success'))
		toast.fire({
			text: "{{session()->get('success')}}",
			icon: "success"
		})
		@php
			session()->forget('success');
		@endphp
		@endif

	</script>
@endsection
