@extends('layouts/layout')

{{--@section('titulo')--}}
{{--    {{$evento->titulo}}--}}
{{--@endsection--}}

@section('conteudo')

	<section id="imagem-principal">
		{{--        <img src="..." class="img-fluid" alt="Responsive image">--}}
	</section>

	<h1 class="display-4 mt-4">Certificado autenticado com sucesso</h1>

	<section class="jumbotron jumbotron-fluid mt-3 p-5">
		<h2 class="display-5 ">Dados de validação </h2>
		<ul>
			<li>Participante: {{$participante->name}}</li>
			<li>Evento: {{$atividade->evento->titulo}}</li>
			<li>Atividade {{$atividade->titulo}}</li>
			<li>Data:{{date('d/m/Y', strtotime($atividade->data))}}</li>
			<li>Carga Horaria: {{$atividade->cargaHoraria}}</li>
			<li>Chave de autenticação: {{$certificado->chave}}</li>
		</ul>
	</section>
@endsection

@section('script')
	<script>
		const toast = Swal.mixin({
			toast:true,
			position: 'top-end',
			showConfirmButton: true,
			timer: 4000,
			dangerMode: true
		})

		@if(session()->has('error'))
		toast.fire({
			text: "{{session()->get('error')}}",
			icon: "warning"
		})
		@php
			session()->forget('error');
		@endphp
		@endif

	</script>
@endsection
