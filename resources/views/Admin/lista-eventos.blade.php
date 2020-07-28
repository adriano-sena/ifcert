@extends('layouts/layout')

@section('titulo')
    Lista de Eventos
@endsection

@section('conteudo')

<a href="{{route('admin.eventos.create')}}" class="btn btn-success mb-2">Criar Evento</a>

    <section id="lista">

    <ul class="list-group">
        @foreach ($eventos as $evento)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="titulo-evento">{{ $evento->titulo }}</span>

                <div id="botoes" class="btn-group">
                    <a href="{{route('admin.eventos.edit', ['evento' => $evento->id])}}" class=" btn btn-success mr-2">
                        Editar
                    </a>

                    <form action="{{route('admin.eventos.destroy', ['evento' => $evento->id])}}" method="POST" class="mr-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>

                    <a href="{{route('admin.atividades.lista', ['evento' => $evento->id]) }}" class="btn btn-primary">Atividades</a>
                </div>
            </li>
        @endforeach
    </ul>

    </section>

    {{ $eventos->links() }}
@endsection
