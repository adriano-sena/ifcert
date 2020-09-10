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
			<h2 class="display-4">Autenticação de certificados</h2>
			<p class="lead">
				Digite a chave de autenticação disponível em seu certificado
			</p>
		</div>
		<div class="container">
			<form action="{{route('autentica')}}" method="post">
				@csrf
				<div class="form-group">
					<label for="chave" class="control-label mb-1">Chave</label>
					<input type="text"  class="form-control @error('chave') is-invalid @enderror" id="chave" name="chave"  value="{{old('chave')}}" required autofocus>
					@error('titulo')
					<span class="invalid-feedback">
						{{$message}}
					</span>
					@enderror
				</div>

				<div>
					<button class="btn btn-small btn-info btn-block">Autenticar</button>
				</div>

			</form>
		</div>
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
