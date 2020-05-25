
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
                            <a href="{{route('eventos.create')}}">
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
                                           <th scope="col" class="text-right">Ações</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eventos as $evento)
                                        <tr>
                                            <td>{{$evento->titulo}}</td>
                                            <td>{{$evento->data}}</td>
                                            <td>{{$evento->local}}</td>
                                            <td class="text-right">
                                             <a href="#Edit" title="Editar">
                                                 <button class="btn btn-success">
                                                  <i class="fa fa-magic"></i>
                                                 </button>
                                             </a>  
                                             <a href="{{route('atividades.lista', ['evento' => $evento->id]) }}" title="Atividades">
                                                 <button class="btn btn-primary">
                                                  <i class="fas fa-book"></i>
                                                 </button>
                                             </a>  
                                             <a href="#Edit" title="Deletar">
                                                 <button class="btn btn-danger">
                                                  <i class="fa fa-trash"></i>
                                                 </button>
                                             </a>  
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