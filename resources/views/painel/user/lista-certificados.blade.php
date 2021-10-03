@extends('layouts.layout')

@section('titulo')
    Lista de certificados
@endsection

@section('conteudo')


    <section class="mt-5">
    <ul class="list-group list-group-flush" >
        @foreach ($certificados as $certificado)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="certificado">{{ $certificado->atividade->titulo}} : {{$certificado->atividade->data}}</span>
					<form action="{{route('user.certificado.show', ['certificado' => $certificado->id])}}" method="POST" class="mr-2">
						@csrf
						@method('get')
						<button type="submit" class="btn btn-primary">Imprimir</button>
					</form>
            </li>
        @endforeach
    </ul>
    </section>

@endsection
