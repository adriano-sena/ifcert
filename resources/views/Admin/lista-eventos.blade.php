@extends('layouts/layout')

@section('titulo')
    Lista de Eventos
@endsection

@section('conteudo')

<a href="{{route('admin.evento.create')}}" class="btn btn-success">Criar Loja</a>
    <section id="lista">
        
    <ul class="list-group">
        @foreach ($eventos as $evento)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="titulo-evento">{{ $evento->titulo }}</span>
                
            </li>
        @endforeach
    </ul>            
    
    
        {{-- <a href="{{route('admin.evento.editar', ['evento' => $evento->id])}}" class="btn btn-primary">Editar</a>
    <a href="{{route('admin.evento.editar', ['evento' => $evento->id])}}" class="btn btn-primary">Atividades</a>
    <a href="{{route('admin.evento.deleta', ['evento' => $evento->id])}}" class="btn btn-danger">Deletar</a> --}}
            
    </section>
@endsection