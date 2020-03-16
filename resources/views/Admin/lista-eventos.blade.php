@extends('layouts/layout')

@section('titulo')
    Lista de Eventos
@endsection

@section('conteudo')

<a href="{{route('admin.evento.create')}}" class="btn btn-success mb-2">Criar Evento</a>

    <section id="lista">
        
    <ul class="list-group">
        @foreach ($eventos as $evento)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="titulo-evento">{{ $evento->titulo }}</span>
                
                <div id="botoes">
                    <a href="{{route('admin.evento.editar', ['evento' => $evento->id])}}" class=" btn btn-success">
                        Editar
                    </a>
                    <a href="{{route('admin.evento.deleta', ['evento' => $evento->id])}}" class="btn btn-danger">Deletar</a>
                    <a href="{{route('atividades.lista', ['evento' => $evento->id])}}" class="btn btn-primary">Atividades</a>
                </div>
            </li>
        @endforeach
    </ul>            
    
    </section>

    {{ $eventos->links() }}
@endsection