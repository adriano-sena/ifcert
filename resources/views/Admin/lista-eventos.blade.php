@extends('layouts/layout')

@section('titulo')
    Lista de Eventos
@endsection

@section('conteudo')

<a href="{{route('admin.evento.create')}}" class="btn btn-success">Criar Loja</a>
    <section id="tabela">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Evento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                <tr>
                    <td>{{$evento->id}}</td>
                    <td>{{$evento->titulo}}</td>
                    <div class="d-flex justify-content-end">
                        <td><a href="{{route('admin.evento.editar', ['evento' => $evento->id])}}" class="btn btn-primary">Editar</a></td>
                        <td><a href="{{route('admin.evento.editar', ['evento' => $evento->id])}}" class="btn btn-primary">Atividades</a></td>
                        <td><a href="{{route('admin.evento.deleta', ['evento' => $evento->id])}}" class="btn btn-danger">Deletar</a></td>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection