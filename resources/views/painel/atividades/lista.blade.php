
@extends('layouts.dashboard-layout')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Atividades</h3>
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-12 text-left mb-2">
                               <a href="{{route('admin.eventos.atividades.create', $evento)}}">
								   <button class="btn btn-success">
									   <i class="fas fa-plus"></i>
									   Criar Atividade
								   </button>
							   </a>
                           </div>

                           <div class="table-responsive">
                               <table class="table">
                                   <thead class="thead-light">
                                       <tr>
                                           <th scope="col">Nome</th>
                                           <th scope="col">Data</th>
                                           <th scope="col">Vagas</th>
                                           <th scope="col">Local</th>
                                           <th scope="col" class="text-right">Ações</th>
                                       </tr>
                                   </thead>

                                   <tbody>
                                    @foreach($atividades as $atividade)
                                    <tr>
                                        <td>{{$atividade->titulo}}</td>
                                        <td>{{$atividade->data}}</td>
                                        <td>{{$atividade->qtd_vagas}}</td>
                                        <td>{{$atividade->local}}</td>
                                        <td class="text-right">

                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Ações
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('admin.eventos.atividades.edit', ['evento' => $evento->id, 'atividade' => $atividade->id])}}"">Editar</a>
                                                <a class="dropdown-item" href="{{route('admin.atividades.inscritos', ['atividade' => $atividade->id])}}">Inscritos</a>
                                                <a class="dropdown-item" href="{{route('admin.atividades.certificados', ['atividade' => $atividade->id])}}">Certificados</a>
                                                <div class="dropdown-divider"></div>
                                                <form  class="dropdown-menu" method="POST" action="{{route('admin.eventos.atividades.destroy', ['evento' => $evento->id, 'atividade' => $atividade->id])}}">
                                                    @csrf
                                                    @method('DELETE')
                                                   <button class="dropdown-item" type="submit">Deletar</button>
                                                </form>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                   </tbody>
                               </table>
							   {{$atividades->links()}}
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
