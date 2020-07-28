
@extends('layouts.dashboard-layout')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Eventos</h3>
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-12 text-right mb-2">
                            <a href="{{route('admin.eventos.create')}}">
                                   <button class="btn btn-success">
                                    <i class="  fa-plus"></i>
                                    Criar Evento
                                   </button>
                               </a>
                           </div>
                           <div class="table-responsive">
                               <table class="table">
                                   <thead class="thead-light">
                                       <tr>
                                           <th scope="col">Nome</th>
                                           <th scope="col">Data</th>
                                           <th scope="col">Local</th>
                                           <th scope="col" class="text-right">Gerencial</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eventos as $evento)
                                        <tr>
                                            <td>{{$evento->titulo}}</td>
                                            <td>{{$evento->data}}</td>
                                            <td>{{$evento->local}}</td>
                                            <td class="text-right">

                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Ações
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('admin.eventos.edit', ['evento' => $evento->id])}}">Editar</a>
                                                    <a class="dropdown-item" href="{{route('admin.atividades.lista', ['evento' => $evento->id]) }}">Atividades</a>
                                                    <a class="dropdown-item" href="{{route('admin.modelo.certificado.create', ['evento' => $evento->id]) }}">Certificado</a>
                                                    <a class="dropdown-item" href="#delete">Deletar</a>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                               </table>
                               {{ $eventos->links()}}
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
