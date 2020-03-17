@extends('layouts/layout')

@section('titulo')
    Lista de Eventos
@endsection

@section('conteudo')

<a href="{{route('eventos.create')}}" class="btn btn-success mb-2">Criar Evento</a>

    <section id="lista">
        
    <ul class="list-group">
        @foreach ($eventos as $evento)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="titulo-evento">{{ $evento->titulo }}</span>
                
                <div id="botoes">
                    <a href="{{route('eventos.edit', ['evento' => $evento->id])}}" class=" btn btn-success">
                        Editar
                    </a>

                    <form action="{{route('eventos.destroy', ['evento' => $evento->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Deletar</button>
                    </form>

                    <a href="{{route('atividades.lista', ['evento' => $evento->id]) }}" class="btn btn-primary">Atividades</a>
                </div>
            </li>
        @endforeach
    </ul>            
    
    </section>

    {{ $eventos->links() }}
@endsection