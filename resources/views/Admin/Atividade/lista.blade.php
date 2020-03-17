@extends('layouts/layout')

@section('titulo')
 {{$evento->titulo}} - Lista de Atividades 
@endsection

@section('conteudo')

<a href="{{route('eventos.atividades.create', $evento)}}" class="btn btn-success mb-2">Criar Atividade</a>

    <section id="lista">
        
        {{$evento}}
    <ul class="list-group">
        @foreach ($atividades as $atividade)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="titulo-atividade">{{ $atividade->titulo }}</span>
                
                <div id="botoes">
                    <a href="{{route('eventos.atividades.edit', ['evento' => $evento->id, 'atividade' => $atividade->id])}}" class=" btn btn-success">
                        Editar
                    </a>
                    <a href="{{route('eventos.atividades.destroy', ['evento' => $evento->id, 'atividade' => $atividade->id])}}" class="btn btn-danger">Deletar</a>
                </div>
            </li>
        @endforeach
    </ul>            
    
    </section>

    {{ $atividades->links() }}
@endsection