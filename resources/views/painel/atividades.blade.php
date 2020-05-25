
@extends('layouts.dashboard-layout')

@section('conteudo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Atividades </h3>
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-12 text-left mb-2">
                               <a href="{{route('eventos.atividades.create', $evento)}}">
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
                                        <a href="#Edit" title="Editar">
                                            <button class="btn btn-success">
                                            <i class="fa fa-magic"></i>
                                            </button>
                                        </a>  
                                        <a href="{{route('eventos.atividades.edit', ['evento' => $evento->id, 'atividade' => $atividade->id])}}" title="Atividades">
                                            <button class="btn btn-primary">
                                            <i class="fas fa-book"></i>
                                            </button>
                                        </a> 
                                        <form method="POST" action="{{route('eventos.atividades.destroy', ['evento' => $evento->id, 'atividade' => $atividade->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>  
                                    @endforeach
                                   </tbody>
                               </table>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection